<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class uploadCSVController extends Controller {


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $preview_header = array();
//        $preview_data = array();
//        return view('uploadcsv',compact('preview_header','preview_data'));
        return view('uploadcsv');
    }
    /**
     * preview the csv being uploaded
     *
     * @return view
     */
    public function preview()
    {
        $target_dir = "Uploads/";

        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOK = 1;

        if(isset($_POST["category"])) {
            $temp_cat = $_POST["category"];
            if ($temp_cat == "student") {
                $category = "student";
            } else if ($temp_cat == "mentor") {
                $category = "mentor";
            } else if ($temp_cat == "report") {
                $category = "report";
            } else {
                $category = "";
            }
        }

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], SITE_ROOT.'/../storage/app/1.csv')){
            $test = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        }else{
            $test = "Sorry, an error occur while uploading, please try again.";
        }

        $config = new LexerConfig();
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $result = array();
        $linecount = 1;
        $interpreter->addObserver(function(array $columns) use (&$result) {
            $result[] = $columns;
        });
        $lexer->parse(SITE_ROOT.'/../storage/app/1.csv', $interpreter);
        $this->CSVContent = $result;
        // parses the uploaded CSV at where is putted in to array
        // result[0] are the headers
        // result[1...n] are the participants
        $preview_data = array();
        foreach ($result as $key => $value) {
            if($key == 0){
                $preview_header = $value;
            }else{
                $value = str_replace('`', '"', $value);
                $preview_data[] = $value;
            }
        }

        return view('uploadcsv',compact('preview_header','preview_data', 'test', 'category'));
    }

    public function upload(){
        $config = new LexerConfig();
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $result = array();
        $linecount = 1;
        $interpreter->addObserver(function(array $columns) use (&$result) {
            $result[] = $columns;
        });
        $lexer->parse(SITE_ROOT.'/../storage/app/1.csv', $interpreter);
        // parses the uploaded CSV at where is putted in to array
        // result[0] are the headers
        // result[1...n] are the participants
        $data = array();
        foreach ($result as $key => $value) {
            if($key == 0){
                $header = $value;
            }else{
                $value = str_replace('`', '"', $value);
                $data[] = $value;
            }
        }
        // var_dump($header);
        // var_dump($data);


        // Given : participant type
        // 		   what is to be upload? (full db backup? matching ? or participant upload)
        // upload procedure :
        // 1. determine the version of CSV (provided version OR generated version)
        // 2. parse EVERYTHING accordingly
        // 3. setup array with input
        // 4. setup SQL statement with array

        // determine the version
        if(array_search("IP Address", $header)!==false){
            //parse with old way
            $this->parseOldCSV($_POST['category'], $header, $data);
        }else{
            //parse with new way
            $this->parseNewCSV($_POST['category'], $header, $data);
        }

        $message = "successfully upload " . $_POST['category'] . " form";
        return view('success',compact('message'));
    }

    public function parseNewCSV($type,$headers,$datas) {
        //Check if category is report, else...
        if ($type == 'report') {
            // Code for insert into reports
            $repo_columns = \Schema::getColumnListing('report');
            $name_index = array();
            foreach ($repo_columns as $column_name) {
                $c_index_in_h = array_search($column_name, $headers);
                array_push($name_index, $c_index_in_h);
            }
            foreach ($datas as $person) {
                $insert_array = array();
                $i = 0;
                foreach ($name_index as $nindex) {
                    $insert_array[$repo_columns[$i]] = $person[$nindex];
                    $i = $i + 1;
                }
                \DB::table('report')->insert(
                    $insert_array
                );
            }
        } else {
            // Grab all pid's where year = 0
            $zero_pid_parts = \DB::table('participant')
                                ->where('year', '0')
                                ->get();

            // Extract pid and email from zero_pid list Array(PID=>EMAIL)
            $pidEmailMap = Array();
            foreach($zero_pid_parts as $one_zero) {
                $pidEmailMap[$one_zero['pid']] = $one_zero['email'];
            }

            // ******* Code for insert into participant *********
            $part_columns = \Schema::getColumnListing('participant');
            $name_index = array();
            foreach ($part_columns as $column_name) {
                $c_index_in_h = array_search($column_name, $headers);
                array_push($name_index, $c_index_in_h);
            }
            foreach ($datas as $person) {
                // Check if $person's pid is a key in $pidEmailMap
                // If it is then just update year
                if (array_key_exists($person[0], $pidEmailMap)) {
                    // Check if email matches csv
                    if ($person[5] == $pidEmailMap[$person[0]]) {
                        // Exists, only update year in participant
                        \DB::table('participant')
                            ->where('pid', $person[0])
                            ->update(['year' => $person[12]]);
                    }
                } else {
                    // Does not exist. Do full insert.
                    $insert_array = array();
                    $i = 0;
                    foreach ($name_index as $nindex) {
                        $insert_array[$part_columns[$i]] = $person[$nindex];
                        $i = $i + 1;
                    }
                    \DB::table('participant')->insert(
                        $insert_array
                    );
                }
            }

            // ******* Code for insert into parameter *********
            // Only run insert if value for extra is not empty
            $para_columns = \Schema::getColumnListing('parameter');
            $name_index = array();
            foreach ($para_columns as $column_name) {
                $c_index_in_h = array_search($column_name, $headers);
                array_push($name_index, $c_index_in_h);
            }
            foreach ($datas as $person) {
                if (array_key_exists($person[0], $pidEmailMap)) {
                    // Person already exists in the database
                    // Check if extra is empty.
                    if ($person[19] != "") {
                        // Exists, only update year in parameter
                        \DB::table('parameter')
                            ->where('pid', $person[0])
                            ->update(['year' => $person[12]]);
                    }
                } else {
                    // Person does not exist in the database. Do entry
                        $insert_array = array();
                        $i = 0;
                        foreach ($name_index as $nindex) {
                            $insert_array[$para_columns[$i]] = $person[$nindex];
                            $i = $i + 1;
                        }
                        if ($insert_array['extra'] != "") {
                            \DB::table('parameter')->insert(
                                $insert_array
                            );
                        }
                    }
            }


            if ($type == 'mentor') {
                //Insert into mentor table
                $ment_columns = \Schema::getColumnListing('mentor');
                $name_index = array();
                foreach ($ment_columns as $column_name) {
                    $c_index_in_h = array_search($column_name, $headers);
                    array_push($name_index, $c_index_in_h);
                }
                foreach ($datas as $person) {
                    if (!array_key_exists($person[0], $pidEmailMap)) {
                        // Person does not exist in the database. Do entry, else no action.
                        $insert_array = array();
                        $i = 0;
                        foreach ($name_index as $nindex) {
                            $insert_array[$ment_columns[$i]] = $person[$nindex];
                            $i = $i + 1;
                        }
                        \DB::table('mentor')->insert(
                            $insert_array
                        );
                    }
                }
            } else {
                // Read 'courses' for 1 row
                // Get header index for 'courses' from $headers
                if (array_search('jid', $headers) != FALSE) {
                    // Insert to junior table
                    $juni_columns = \Schema::getColumnListing('junior');
                    $name_index = array();
                    foreach ($juni_columns as $column_name) {
                        $c_index_in_h = array_search($column_name, $headers);
                        array_push($name_index, $c_index_in_h);
                    }
                    foreach ($datas as $person) {
                        if (!array_key_exists($person[0], $pidEmailMap)) {
                            // Person does not exist in the database. Do entry, else no action.
                            $insert_array = array();
                            $i = 0;
                            foreach ($name_index as $nindex) {
                                $insert_array[$juni_columns[$i]] = $person[$nindex];
                                $i = $i + 1;
                            }
                            \DB::table('junior')->insert(
                                $insert_array
                            );
                        }
                    }
                } else {
                    // Insert to senior table
                    $seni_columns = \Schema::getColumnListing('senior');
                    $name_index = array();
                    foreach ($seni_columns as $column_name) {
                        $c_index_in_h = array_search($column_name, $headers);
                        array_push($name_index, $c_index_in_h);
                    }
                    foreach ($datas as $person) {
                        if (!array_key_exists($person[0], $pidEmailMap)) {
                            // Person does not exist in the database. Do entry, else no action.
                            $insert_array = array();
                            $i = 0;
                            foreach ($name_index as $nindex) {
                                $insert_array[$seni_columns[$i]] = $person[$nindex];
                                $i = $i + 1;
                            }
                            \DB::table('senior')->insert(
                                $insert_array
                            );
                        }
                    }
                }
            }
        }

    }

    public function parseOldCSV($type,$headers,$datas){
        set_time_limit(180);
        // print($type);
        // $type is either mentors or student
        // header string require for participant
        $participant_target_keywords = array("---", // pid
            "Given",
            "Family",
            "Gender",
            "date",
            "mail",
            "Phone",
            "alternate",
            "Birth year",
            "reference", // gender preference
            "TM previous" ,
            "CS areas of interest" // past participant // waitlist // interest
        );
        $mentor_target_keywords = array("---", // mid
            "title", // job title
            "Years of CS", // year of CS
            "level of education", //edu lv
            "Current employer"
        );
        $student_target_keywords = array("---",
            "Student number",// student num
            "Year of study ",// year stand
            "Program of study",//programOfStudy
            "---",//courses
            "---",//csid
            "Co-op status"// co op
        );

        // foreach participant in data
        $listOfParticipant = array();
        $listOfMentor = array();
        $listOfStudent = array();
        $listOfParameter = array();



        foreach ($datas as $person) {
            $headers_clone = $headers;

            // construct participant value array
            $participant_values = array();
            foreach ($participant_target_keywords as $keyword) {
                // go through headers to find the index
                $value ="";
                for ($i=0; $i < count($headers_clone)-1; $i++) {
                    $header = $headers_clone[$i];
                    if (strpos($header, $keyword) !== FALSE){
                        $text = preg_replace("/[\r\n]+/", " ", $person[$i]);
                        $value = $text;
                        break;
                    }elseif ($keyword == "date"){
                        $temp = array();
                        foreach ($person as $key => $value) {
                            switch ($value) {
                                case 'First Choice':
                                    if(array_key_exists(0, $temp)){
                                        $temp[] = $headers[$key];
                                    }else{
                                        $temp[0] = $headers[$key];
                                    }
                                    break;
                                case 'Second Choice':
                                    if(array_key_exists(1, $temp)){
                                        $temp[] = $headers[$key];
                                    }else{
                                        $temp[1] = $headers[$key];
                                    }
                                    break;
                                case 'Third Choice':
                                    if(array_key_exists(2, $temp)){
                                        $temp[] = $headers[$key];
                                    }else{
                                        $temp[2] = $headers[$key];
                                    }
                                    break;
                                case 'Not Avail.':
                                    # dont do shit
                                    break;
                            }
                        }

                        $temp = $this->format_date($temp);
                        $value = implode(",", $temp);
                    }
                }

                $participant_values[] = $value;
            }

            $listOfParticipant[] =$participant_values;
            // var_dump($participant_values);
            // print("\n===============================\n");

            if($type == "mentor"){
                // construct mentor value array
                $mentor_values = array();
                foreach ($mentor_target_keywords as $keyword) {
                    // go through headers to find the index
                    $value ="";
                    for ($i=0; $i < count($headers_clone)-1; $i++) {
                        $header = $headers_clone[$i];
                        if (strpos($header, $keyword) !== FALSE){
                            $text = preg_replace("/[\r\n]+/", " ", $person[$i]);
                            $value = $text;
                            break;
                        }
                    }
                    $mentor_values[] = $value;
                }
                // var_dump($mentor_values);
                $listOfMentor[] = $mentor_values;
                // print("\n===============================\n");
                $leftover = array_diff($person, $mentor_values,$participant_values,array("First Choice","Second Choice","Third Choice","Not Avail."));
                // var_dump($leftover);
                $parameter_value = array();
                $parameter_value[] = "";
                $parameter_value[] = date("Y");
                $empStat = array();
                $extra = "{";
                foreach ($leftover as $key => $value) {
                    $title = $headers[$key];
                    $text = preg_replace("/[\r\n]+/", " ", $value);
                    if (($value == "X" || $value == "x") && $title != "CS Alumni/ae"){
                        $empStat[] = $title;
                    }else{
                        $extra .= '"' . $title .'"' . ":" . '"' . $text .'"' . ",";
                    }
                }
                $extra .= '"EmploymentStatus" :' . '"' . implode(",", $empStat) . '"}';
                $parameter_value[] = $extra;
                $listOfParameter[] = $parameter_value;

            }else{
                // construct student value array
                $student_values = array();
                foreach ($student_target_keywords as $keyword) {
                    // go through headers to find the index
                    $value ="";
                    for ($i=0; $i < count($headers_clone)-1; $i++) {
                        $header = $headers_clone[$i];
                        if (strpos($header, $keyword) !== FALSE){
                            $text = preg_replace("/[\r\n]+/", " ", $person[$i]);
                            $value = $text;
                            break;
                        }
                    }
                    $student_values[] = $value;
                }
                // var_dump($student_values);
                $listOfStudent[] = $student_values;
                $leftover = array_diff($person, $student_values,$participant_values,array("First Choice","Second Choice","Third Choice","Not Avail."));
                // var_dump($leftover);
                $parameter_value = array();
                $parameter_value[] = "";
                $parameter_value[] = date("Y");
                $empStat = array();
                $extra = "{";
                foreach ($leftover as $key => $value) {
                    $title = $headers[$key];
                    $text = preg_replace("/[\r\n]+/", " ", $value);
                    if (($value == "X" || $value == "x") && $title != "CS Alumni/ae"){
                        $empStat[] = $title;
                    }else{
                        $extra .= '"' . $title .'"' . ":" . '"' . $text .'"' . ",";
                    }
                }
                $extra .= '"EmploymentStatus" :' . '"' . implode(",", $empStat) . '"}';
                $parameter_value[] = $extra;
                // var_dump($student_values);
                // var_dump($parameter_value);
                $listOfParameter[] = $parameter_value;
                // print("\n===============================\n");
            }
            //===============================================================
            // the rest goes into extra

            // $parameter_value = array();
            // $parameter_value[] = ""; // pid
            // $parameter_value[] = date("Y");
            // for ($i=0; $i < count($headers_clone)-1; $i++) {
            // 	$header = $headers_clone[$i];
            // 	if (strpos($header, $keyword) !== FALSE){
            // 		$value = $person[$i];
            // 		unset($headers_clone[$i]);
            // 		unset($person[$i]);
            // 		break;
            // 	}
            // }
            // break;
        }


        // insert to participant
        // var_dump($participant_values);
        // $REAL = "[";
        // $REAL .= implode(",", $participant_values);
        // $REAL .="]";
        // \DB::insert('insert into innodb.participant (pid, First name, Family name, gender, kickoff, email, phone, phone alt, birth year,genderpref, past participation, waitlist, year) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $participant_values);
        $listOfID = array();
        $existing_email= \DB::table('participant')->lists('year','email');
        $LOPcount = count($listOfParticipant);
        for ($i=0; $i < $LOPcount; $i++) { 
            // echo "<p> ". $i . "</p>";
            if((array_key_exists($listOfParticipant[$i][5], $existing_email))&&
                ($existing_email[$listOfParticipant[$i][5]] == date("Y"))){
                unset($listOfParticipant[$i]);
                if (count($listOfMentor) > 0)
                    unset($listOfMentor[$i]);
                if (count($listOfStudent) > 0)
                    unset($listOfStudent[$i]);
                if (count($listOfParameter) > 0)
                    unset($listOfParameter[$i]);
            }
        }

        foreach ($listOfParticipant as $participant_values) {
            $participant_id = \DB::table('participant')->insertGetId(
                ['First name' => $participant_values[1],
                    'Family name' => $participant_values[2],
                    'gender' => $participant_values[3],
                    'kickoff' => $participant_values[4],
                    'email' => $participant_values[5],
                    'phone' => $participant_values[6],
                    'phone alt' => $participant_values[7],
                    'birth year' => $participant_values[8],
                    'genderpref' => $participant_values[9],
                    'past participation' => $participant_values[10],
                    'interest' => $participant_values[11],
                    'waitlist' => "0",
                    'year' => date("Y")

                ]);

            $pid = \DB::table('participant')->where('email', $participant_values[5])->where('year', date("Y"))->pluck('pid');
            $listOfID[] = $pid;
        }
        // var_dump($listOfID);
        // insert into mentor
        // var_dump($mentor_values);
        if (count($listOfMentor) > 0){
            $i = 0;
            foreach ($listOfMentor as $mentor_values) {
                \DB::table('mentor')->insert(
                    ['mid' => $listOfID[$i],
                        'job' => $mentor_values[1],
                        'yearofcs' => $mentor_values[2],
                        'edulvl' => $mentor_values[3],
                        'company' => $mentor_values[4]
                    ]
                );
                $i++;
            }
        }elseif (count($listOfStudent) > 0){
            $i = 0;
            foreach ($listOfStudent as $student_values) {
                if (($student_values[2]== "3rd year")||($student_values[2]== "4th year")){
                    \DB::table('senior')->insert(
                        ['sid' => $listOfID[$i],
                            'studentNum' => $student_values[1],
                            'yearStand' => $student_values[2],
                            'programOfStudy' => $student_values[3],
                            'courses' => $student_values[4],
                            'csid' => $student_values[5],
                            'coop' => $student_values[6]
                        ]
                    );
                }else{
                    \DB::table('junior')->insert(
                        ['jid' => $listOfID[$i],
                            'studentNum' => $student_values[1],
                            'yearStand' => $student_values[2],
                            'programOfStudy' => $student_values[3],
                            'courses' => $student_values[4],
                            'csid' => $student_values[5],
                            'coop' => $student_values[6]
                        ]
                    );
                }

                $i++;
            }
        }

        if (count($listOfParameter) > 0){
            $i = 0;
            foreach ($listOfParameter as $parameter_value) {
                \DB::table('parameter')->insert(
                    ['pid' => $listOfID[$i],
                        'year' => $parameter_value[1],
                        'extra' => $parameter_value[2]
                    ]
                );
                $i++;
            }
        }




    }
    public function format_date($arrayOfDate){
        $result = array();
        foreach ($arrayOfDate as $key) {
            $result[] = date("Y-m-d", strtotime($key));
        }
        return $result;
    }





}
