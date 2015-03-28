<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\EditParticipantRequest;

class AdminController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin');
    }

    public function studentsview()
    {
        // Retrieve junior and senior students from database
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')->get();   
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')->get();
                                                  
        // Merge these two results 
        $result = array_merge($junior_result, $senior_result);

        return \View::make('students')->with('result', $result);
    }
   
    public function mentorsview()
    {
        // Retrieve mentors from database
        $result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')->get();
        return \View::make('mentors')->with('result', $result); 
    }

     public function waitlist()
    {
        $date = date("Y");
        $result = \DB::table('participant')->where('waitlist', 1)->where('year', $date)->get();
        
        return \View::make('waitlist')->with('result', $result);
    }

    public function viewLog()
    {
        // Make select call to log table
//        $result = \DB::table('log')->orderBy('logID','desc')->get();
        // Return view with log array
        return \View::make('log');
    }

    public function viewLog2()
    {
        // Make select call to log table
        $retrieveAmount = $_POST["numRetrieve"];
        $result = \DB::table('log')->take($retrieveAmount)->orderBy('logID','desc')->get();
        // Return view with log array
        return \View::make('log')->with('result',$result);
    }

    public function studentSearch()
    {
        $dropdown = $_POST['search_param'];
        $text = $_POST['text'];
        //validates search param 
        // $pattern = '/([1-9][0-9]{7})|([a-z][0-9][a-z][0-9])|([a-zA-Z]+\ ?[a-zA-Z]*)/';

        // preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);

        // $matches = $matches[0][0];
        // if(strcmp($text, $matches) != 0)
        // {
        //     echo "input error, please make sure the input value is a name, student number or cs-id";
        // }
        // else
        // {
        //     if(strcmp($dropdown, "junior students") == 0){
        //         echo "search junior student";
        //     }

        //     if(strcmp($dropdown, "senior students") == 0){
        //         echo "search senior student";
        //     }

        //     if(strcmp($dropdown, "all") == 0){
        //         echo $dropdown; 
        //         echo "<br>";
        //         echo $text;
        //         echo "<br>";
        //         echo $pattern;
        //         echo "<br>";
        //     }
        // }
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('First name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('studentNum', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('csid', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('email', 'LIKE', '%'.$text.'%')
                                                  ->get();

        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('First name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('studentNum', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('csid', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('email', 'LIKE', '%'.$text.'%')
                                                  ->get();
        
        if (strcmp($dropdown, "junior students") == 0) 
        {
            //result query - joins participant table with junior student 
            $result = $junior_result;
        }

        else if (strcmp($dropdown, "senior students") == 0) 
        {
            //result query - joins participant table with senior student 
            $result = $senior_result;
        }
        else 
        {
            $result = array_merge($junior_result, $senior_result);
        }

        return \View::make('students')->with('result', $result);
    }

    //TODO: regex to check for correct input? <- not sure if necessary 
    public function mentorSearch()
    {
        $text = $_POST['text'];

        $result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                           ->where('First name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('email', 'LIKE', '%'.$text.'%')
                                           ->get();

        return \View::make('mentors')->with('result', $result);
    }

    public function waitlistSearch()
    {
        $text = $_POST['text'];

        $result = \DB::table('participant')->where('First name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('email', 'LIKE', '%'.$text.'%')
                                           ->get();

        return \View::make('waitlist')->with('result', $result);
    }

    public function showParticipant($pid) 
    {
        // To be used in participant.blade.php
        $jid = \DB::table('junior')->where('jid', $pid)->pluck('jid');
        $sid = \DB::table('senior')->where('sid', $pid)->pluck('sid');
        $mid = \DB::table('mentor')->where('mid', $pid)->pluck('mid');

        // Array of the id's to get checked 
        $id_array = array($jid, $sid, $mid);

        // Gets all mentor senior and junior students possible data 
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid',$pid)->get();


        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        //json parse the parameter data (extra column in parameter table)
        $extra_decoded = json_decode($json_extra, true);
        $participant_result = array_merge($junior_result, $senior_result, $mentor_result);

        return \View::make('participant')->with('participant_result', $participant_result)
                                         ->with('json_extra', $json_extra)
                                         ->with('id_array', $id_array);
    }

    public function editParticipant(EditParticipantRequest $request, $pid)
    {
        // UPDATE COLUMNS IN PARTICIPANT TABLE 
        \DB::table('participant')->where('pid', $pid)
                                 ->update(['First name'         => $request['firstname'],
                                           'Family name'        => $request['familyname'],
                                           'email'              => $request['email'],
                                           'gender'             => $request['gender'],
                                           'birth year'         => $request['birthyear'],
                                           'phone'              => $request['phone'],
                                           'phone alt'          => $request['phonealt'],
                                           'kickoff'            => $request['kickoff'],
                                           'genderpref'         => $request['genderpref'],
                                           'past participation' => $request['pastparticipation'],
                                           'interest'           => $request['interest']
                                           ]);

        // To be used in participant.blade.php
        $jid = \DB::table('junior')->where('jid', $pid)->pluck('jid');
        $sid = \DB::table('senior')->where('sid', $pid)->pluck('sid');
        $mid = \DB::table('mentor')->where('mid', $pid)->pluck('mid');

        $id_array = array($jid, $sid, $mid);

        // UPDATE PARTICIPANT IF JUNIOR STUDENT 
        if ($jid == $pid) 
        {
            \DB::table('junior')->where('jid', $pid)
                                ->update(['studentNum'     => $request['studentnum'],
                                          'yearStand'      => $request['yearstanding'],
                                          'programOfStudy' => $request['program'],
                                          'courses'        => $request['courses'],
                                          'csid'           => $request['csid'],
                                          'coop'           => $request['coop']
                                          ]);
        }
        // UPDATE PARTICIPANT IF SENIOR STUDENT 
        else if ($sid == $pid)
        {
            \DB::table('mentor')->where('sid', $pid)
                                ->update(['studentNum'     => $request['studentnum'],
                                          'yearStand'      => $request['yearstanding'],
                                          'programOfStudy' => $request['program'],
                                          'courses'        => $request['courses'],
                                          'csid'           => $request['csid'],
                                          'coop'           => $request['coop']
                                          ]);
        }
        // UPDATE PARTICIPANT IF MENTOR
        else
        {
            \DB::table('mentor')->where('mid', $pid)
                                ->update(['yearofcs' => $request['yearofcs'],
                                          'job' => $request['job'],
                                          'edulvl' => $request['edulvl']
                                          ]);
        }
        
        // Query here because need to fetch the keys (ex. CS Areas of Interest)
        // CURRENT DATA IN DATABASE PRE-EDITED
        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        // Decode JSON format of the extra column, then populate an array of keys 
        $extra = json_decode($json_extra, true);
        $extra_keys = array_keys($extra);

        // Make array for json_encode
        $extra_update = array();

        //populate array
        foreach($extra_keys as $key)
        {
            if ($key == "SID" || $key == "Time") 
            {
                // maintain original data
                $extra_update[$key] = $extra[$key];
            }
            else
            {
                //the actual edit takes place here
                //for some reason null values if not trimmed
                $no_spaces_key = preg_replace('/\s+/', '', $key);
                $extra_update[$key] = $request[$no_spaces_key];
            }
        }

        $encoded_extra_update = json_encode($extra_update);

        // UPDATE EXTRAS COLUMN IN PARAMETER
        \DB::table('parameter')->where('pid', $pid) 
                               ->update(['extra' => $encoded_extra_update]);

        // Gets all mentor senior and junior students possible data
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid', $pid)->get();


        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        $participant_result = array_merge($junior_result, $senior_result, $mentor_result);

        return \View::make('participant')->with('participant_result', $participant_result)
                                         ->with('json_extra', $json_extra)
                                         ->with('id_array', $id_array);
    }

    public function downloadcsv()
    {
        $range = \DB::table('participant')->select('year')->groupBy('year')->get();
//        return view('downloadcsv');
        $year = 2014;
        if (isset($_POST['year_csv'])) {
            $year = $_POST['year_csv'];
        }
        return \View::make('downloadcsv')->with('year', $year)->with('range',$range);
    }

    function recursiveRemoveDirectoryFiles($directory)
    {
        foreach(glob("{$directory}/*") as $file)
        {
            if(is_dir($file)) {
                recursiveRemoveDirectoryFiles($file);
            } else {
                unlink($file);
            }
        }
    }

    public function downloadCSVfile()
    {

//        // TODO: Update this function to be able to specify the CSV that we want.
//        //      Probably after extracting data from table and creating a CSV we can decide on some concrete logic for this section.
//        //      For now just downloads TestingCSV.csv from public/
//
//        $file= public_path(). "/TestingCSV.txt";
//        $headers = array(
//            'Content-Type: text/plain',
//        );
//        return response()->download($file, 'TestingCSV.txt', $headers);


        $year = $_POST['year_csv'];

        $junior_pap = \DB::table('participant')
            ->where('participant.year','=', $year)->join('junior', 'participant.pid', '=', 'junior.jid')
            ->leftjoin('parameter', function($join) use ($year)
            {
                $join->on('participant.pid', '=', 'parameter.pid')
                    ->where('parameter.year', '=', $year);
            })->select(\DB::raw('participant.pid AS pid,
                        `First name` AS `First name`,
                        `Family name` AS `Family name`,
                        gender AS gender,
                        kickoff AS kickoff,
                        email AS email,
                        phone AS phone,
                        `phone alt` AS `phone alt`,
                        `birth year` AS `birth year`,
                        genderpref AS genderpref,
                        `past participation` AS `past participation`,
                        waitlist AS waitlist,
                        participant.year AS year,
                        interest AS interest,
                        jid AS jid,
                        studentNum AS studentNum,
                        yearStand AS yearStand,
                        programOfStudy AS programOfStudy,
                        courses AS courses,
                        csid AS csid,
                        coop AS coop,
                        extra AS extra'))
            ->get();
        $senior_pap = \DB::table('participant')
            ->where('participant.year','=', $year)->join('senior', 'participant.pid', '=', 'senior.sid')
            ->leftjoin('parameter', function($join) use ($year)
            {
                $join->on('participant.pid', '=', 'parameter.pid')
                    ->where('parameter.year', '=', $year);
            })->select(\DB::raw('participant.pid AS pid,
                        `First name` AS `First name`,
                        `Family name` AS `Family name`,
                        gender AS gender,
                        kickoff AS kickoff,
                        email AS email,
                        phone AS phone,
                        `phone alt` AS `phone alt`,
                        `birth year` AS `birth year`,
                        genderpref AS genderpref,
                        `past participation` AS `past participation`,
                        waitlist AS waitlist,
                        participant.year AS year,
                        interest AS interest,
                        sid AS sid,
                        studentNum AS studentNum,
                        yearStand AS yearStand,
                        programOfStudy AS programOfStudy,
                        courses AS courses,
                        csid AS csid,
                        coop AS coop,
                        extra AS extra'))
            ->get();
        $mentor_pap = \DB::table('participant')
            ->where('participant.year','=', $year)->join('mentor', 'participant.pid', '=', 'mentor.mid')
            ->leftjoin('parameter', function($join) use ($year)
            {
                $join->on('participant.pid', '=', 'parameter.pid')
                    ->where('parameter.year', '=', $year);
            })->select(\DB::raw('participant.pid AS pid,
                        `First name` AS `First name`,
                        `Family name` AS `Family name`,
                        gender AS gender,
                        kickoff AS kickoff,
                        email AS email,
                        phone AS phone,
                        `phone alt` AS `phone alt`,
                        `birth year` AS `birth year`,
                        genderpref AS genderpref,
                        `past participation` AS `past participation`,
                        waitlist AS waitlist,
                        participant.year AS year,
                        interest AS interest,
                        mid AS mid,
                        job AS job,
                        yearofcs AS yearofcs,
                        edulvl AS edulvl,
                        extra AS extra'))
            ->get();

        // TODO: Clean the local directory holding download csvs

        $download_dir = "downloadFiles";
        if (is_dir($download_dir)) {
            $this->recursiveRemoveDirectoryFiles($download_dir);
        } else {
            mkdir($download_dir);
        }

        // TODO: Delete any possible download zip file from previous downloads
        if (file_exists("downloadFiles.zip")) {
            unlink("downloadFiles.zip");
        }


        //*****************************************************************

        // Create CSV/TXT file local FOR JUNIOR
        $junior_file_name = "downloadFiles/juniorCSV" . $year . ".txt";
        $junior_file = fopen($junior_file_name, "a");

        $single_pap = $junior_pap[0];
        $key_array = array_keys($single_pap);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($junior_file, $one_key . ",");
        }
        // Write endline
        fwrite($junior_file, "\r\n");

        // Write values for each entry
        foreach($junior_pap as $single_junior) {
            // Get values for single_junior:
            $single_junior_values = array_values($single_junior);
            // Write each value to the junior file:
            foreach($single_junior_values as $single_junior_value) {
                fwrite($junior_file, "\"" . $single_junior_value . "\"" . ",");
            }
            // Write endline
            fwrite($junior_file, "\r\n");
        }

        //Close file
        fclose($junior_file);

        //*****************************************************************

        // Create CSV/TXT file local FOR SENIOR
        $senior_file_name = "downloadFiles/seniorCSV" . $year . ".txt";
        $senior_file = fopen($senior_file_name, "a");

        $single_pap = $senior_pap[0];
        $key_array = array_keys($single_pap);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($senior_file, $one_key . ",");
        }
        // Write endline
        fwrite($senior_file, "\r\n");

        // Write values for each entry
        foreach($senior_pap as $single_senior) {
            // Get values for single_junior:
            $single_senior_values = array_values($single_senior);
            // Write each value to the junior file:
            foreach($single_senior_values as $single_senior_value) {
                fwrite($senior_file, "\"" . $single_senior_value . "\"" . ",");
            }
            // Write endline
            fwrite($senior_file, "\r\n");
        }

        //Close file
        fclose($senior_file);

        //*****************************************************************

        // Create CSV/TXT file local FOR MENTOR
        $mentor_file_name = "downloadFiles/mentorCSV" . $year . ".txt";
        $mentor_file = fopen($mentor_file_name, "a");

        $single_pap = $mentor_pap[0];
        $key_array = array_keys($single_pap);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($mentor_file, $one_key . ",");
        }
        // Write endline
        fwrite($mentor_file, "\r\n");

        // Write values for each entry
        foreach($mentor_pap as $single_mentor) {
            // Get values for single_junior:
            $single_mentor_values = array_values($single_mentor);
            // Write each value to the junior file:
            foreach($single_mentor_values as $single_mentor_value) {
                fwrite($mentor_file, "\"" . $single_mentor_value . "\"" . ",");
            }
            // Write endline
            fwrite($mentor_file, "\r\n");
        }

        //Close file
        fclose($mentor_file);

        //Zip up all files in downloadFiles directory
        $download_file_zip = 'downloadFiles.zip';
        $files = glob('downloadFiles/*');
        \Zipper::make($download_file_zip)->add($files);
        \Zipper::close();

        //Send file
        $headers = array(
            'Content-Type: application/zip'
        );

        return response()->download("downloadFiles.zip", "TMMSParticipant".$year.".zip", $headers);
    }

}
