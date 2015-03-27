<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class appLoaderController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 *
	 */
	public function index()
    {
        //extra questions
        $newQuestions = [];

        //grabbing raw questions from database
        $year = date("Y");
        $rawMenApp = \DB::table('mentorapp')->where('year', $year)->first();
        $rawQuestion = $rawMenApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,id,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        //split the questions into just the tags
        //such that we can use the tags to check if form submitted anything
        $variables = [];
        $countQ = count($newQuestions);
        for($i = 0; $i < $countQ; $i++){
            array_push($variables, $newQuestions[$i][1]);
        }

        //check if anything was posted for the extra's questions and grab the answers
        $paralist = [];
        $insert = "";
        $countV = count($variables);

        for($k = 0; $k < $countV; $k++){
            if(isset($_POST[$variables[$k]])){
                if($_POST[$variables[$k]] != ""){
                    $middle = "";
                    if(count($_POST[$variables[$k]]) > 1){
                        $combineVariable = $_POST[$variables[$k]];
                        for($m = 1; $m < count($_POST[$variables[$k]]) ; $m++){
                            //array_push($paralist, $combineVariable[$m + 1]);
                            if($m == (count($_POST[$variables[$k]]) - 1)) {
                                $middle .= $combineVariable[$m];
                            }else{
                                $middle .= $combineVariable[$m] . ',';
                            }
                        }
                    }else{
                        //array_push($paralist, $_POST[$variables[$k]]);
                        $middle = $middle . $_POST[$variables[$k]];
                    }
                    $insert .= '"' . $variables[$k] . '":"' . $middle . '",';
                    $combineInsert = $insert;
                }
            }
        }

        //$parameter = implode("," , $paralist);
        $parameter = '{' . substr($combineInsert,0,-1) . '}';

        return View('appEdit')->with('parameter',$parameter);
    }

	/**
	 * Grab student application form
	 *
	 *
	 */
	public function grabStudentApp()
	{
		//grab application form from DB for current year
        $year = date("Y");
        $rawApp = \DB::table('studentapp')->where('year', $year)->first();

        //return $rawApp;

        //break into different elements to get the text for HTML

        //Courses offered @ UBC student may have taken
//        $rawCourse = $rawApp["courses"];
//        $course = explode("," , $rawCourse);
//        foreach($course as $c){
//            echo $c . "<br>";
//        }

        //Current programs offered at UBC that have affiliation with CPSC
        $rawProgram =$rawApp["program"];
        $program = explode("," , $rawProgram);

        //Current dates for planned Kickoff night
        $rawKickoff = $rawApp["kickoff"];
        $kickoff = explode(",", $rawKickoff);

        //if element is a new question (contains |) then break it down into (format|id|question|answerA,answerB,answerC`format2|id2|question2|answer)
        //pass view HTML tags? or just variables?
        $newQuestions = [];

        $rawQuestion = $rawApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        return View('studentapp')-> with ('program', $program)-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
	}


    public function grabStudentAppEdit()
    {
        //grab application form from DB for current year
        $year = date("Y");
        $rawApp = \DB::table('studentapp')->where('year', $year)->first();

        //return $rawApp;

        //break into different elements to get the text for HTML

        //Courses offered @ UBC student may have taken
//        $rawCourse = $rawApp["courses"];
//        $course = explode("," , $rawCourse);
//        foreach($course as $c){
//            echo $c . "<br>";
//        }

        //Current programs offered at UBC that have affiliation with CPSC
        $rawProgram =$rawApp["program"];
        $program = explode("," , $rawProgram);

        //Current dates for planned Kickoff night
        $rawKickoff = $rawApp["kickoff"];
        $kickoff = explode(",", $rawKickoff);

        //if element is a new question (contains |) then break it down into (format|id|question|answerA,answerB,answerC`format2|id2|question2|answer)
        //pass view HTML tags? or just variables?
        $newQuestions = [];

        $rawQuestion = $rawApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        return View('studentform')-> with ('program', $program)-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
    }

    /**
     * Grab mentor application form and pass to mentorapp.blade.php
     *
     *
     */
    public function grabMentorApp()
    {
        //grab application form from DB for current year
        $year = date("Y");
        $rawApp = \DB::table('mentorapp')->where('year', $year)->first();

        //return $rawApp;

        //break into different elements to get the text for HTML

        //Current dates for planned Kickoff night
        $rawKickoff = $rawApp["kickoff"];
        $kickoff = explode(",", $rawKickoff);

        //if element is a new question (contains |) then break it down into (format|id|question|answerA,answerB,answerC`format2|id2|question2|answer)
        //pass view HTML tags? or just variables?
        $newQuestions = [];

        $rawQuestion = $rawApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,id,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        return View('mentorapp')-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
    }


/**
     * Grab mentor application form and pass to mentorform.blade.php
     *
     *
     */
    public function grabMentorAppEdit()
    {
        //grab application form from DB for current year
        $year = date("Y");
        $rawApp = \DB::table('mentorapp')->where('year', $year)->first();

        //return $rawApp;

        //break into different elements to get the text for HTML

        //Current dates for planned Kickoff night
        $rawKickoff = $rawApp["kickoff"];
        $kickoff = explode(",", $rawKickoff);

        //if element is a new question (contains |) then break it down into (format|id|question|answerA,answerB,answerC`format2|id2|question2|answer)
        //pass view HTML tags? or just variables?
        $newQuestions = [];

        $rawQuestion = $rawApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,id,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        return View('mentorform')-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
    }


    /**
     *
     * insert application form answers into database
     * {"name":"bob","gender":"female","age":5}
     */
    public function studentToDB(){
        //all participants attributes
        $givenname = $_POST['givenname'];
        $familyname = $_POST['familyname'];
        $gender = $_POST['gender'];
        //kickoff
        $day1 = $_POST['day1'];//format of YYYY-MM-DD
        $day2 = $_POST['day2'];
        $day3 = $_POST['day3'];
        $additionalcomments_avail = $_POST['additionalcomments_avail'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $phonealt = $_POST['phonealt'];
        $birthyear = $_POST['birthyear'];
        $mentorgender = $_POST['mentorgender'];
        $participation = $_POST['participation'];
        $year = date("Y"); //2015
        $month = date("m"); //02
        $date = date("d"); //01

        //determine if registering past a deadline
        $rawApp = \DB::table('studentapp')->where('year',$year)->first();
        $rawDeadline = $rawApp['deadline'];
        $deadline = explode("-",$rawDeadline); //year, month, day
        if($year > $deadline[0]){
            $waitlist = 1;
        }elseif($month > $deadline[1]){
            $waitlist = 1;
        }elseif($date > $deadline[2]){
            $waitlist = 1;
        }else{
            $waitlist = 0;
        }

        //inserting into participant table
        $participant_id = \DB::table('participant')->insertGetId(
                ['First name' => $givenname, 'Family name' => $familyname,
                'gender' => $gender, 'kickoff' => $day1 . "," .  $day2 . "," . $day3 . "," . $additionalcomments_avail,
                'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
                'birth year' => $birthyear, 'genderpref' => $mentorgender,
                'past participation' => $participation, 'waitlist' => $waitlist, 'year' => $year]
        );

        //student only
        $studentnum = $_POST['studentnum'];
        $yearofstudy = $_POST['yearofstudy'];
        $programofstudy = $_POST['programofstudy'];
        $programofstudy_other = $_POST['programofstudy_other'];
        $course = $_POST['course']; //array
        $csid = $_POST['csid'];
        $coop = $_POST['coop'];


        //detemine if it is a senior or junior student (determined if they took all the listed CPSC courses)
        //insert accordingly, with sid OR jid = participant_id
        if(count($course)==4){
            $senior_response = \DB::table('senior')->insert(
                    ['sid' => $participant_id, 'studentNum' => $studentnum, 'yearStand' => $yearofstudy,
                    'programOfStudy' => $programofstudy . $programofstudy_other, 'courses' => $course, 'csid' => $csid,
                    'coop' => $coop]
            );
        }else{
            $junior_response = \DB::table('junior')->insert(
                    ['jid' => $participant_id, 'studentNum' => $studentnum, 'yearStand' => $yearofstudy,
                    'programOfStudy' => $programofstudy . $programofstudy_other, 'courses' => $course, 'csid' => $csid,
                    'coop' => $coop]
            );
        }

        //extra questions
        $newQuestions = [];

        //grabbing raw questions from database
        $year = date("Y");
        $rawStuApp = \DB::table('studentapp')->where('year', $year)->first();
        $rawQuestion = $rawStuApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,id,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        //split the questions into just the tags
        //such that we can use the tags to check if form submitted anything
        $variables = [];
        $countQ = count($newQuestions);
        for($i = 0; $i < $countQ; $i++){
            array_push($variables, $newQuestions[$i][1]);
        }

        //check if anything was posted for the extra's questions and grab the answers


//        $paralist = [];
//        $countV = count($variables);
//
//        for($k = 0; $k < $countV; $k++){
//            if(isset($_POST[$variables[$k]])){
//                if($_POST[$variables[$k]] != ""){
//                    if(count($_POST[$variables[$k]]) > 1){
//                        $combineVariable = $_POST[$variables[$k]];
//                        for($m = 0; $m < (count($combineVariable) - 1) ; $m++){
//                            array_push($paralist, $combineVariable[$m + 1]);
//                        }
//                    } else {
//                        array_push($paralist, $_POST[$variables[$k]]);
//                    }
//                }
//            }
//        }
//
//        $parameter = implode("," , $paralist);




        //$paralist = [];
        $insert = "";
        $countV = count($variables);

        for($k = 0; $k < $countV; $k++){
            if(isset($_POST[$variables[$k]])){
                if($_POST[$variables[$k]] != ""){
                    $middle = "";
                    if(count($_POST[$variables[$k]]) > 1){
                        $combineVariable = $_POST[$variables[$k]];
                        for($m = 1; $m < count($_POST[$variables[$k]]) ; $m++){
                            //array_push($paralist, $combineVariable[$m + 1]);
                            if($m == (count($_POST[$variables[$k]]) - 1)) {
                                $middle .= $combineVariable[$m];
                            }else{
                                $middle .= $combineVariable[$m] . ',';
                            }
                        }
                    }else{
                        //array_push($paralist, $_POST[$variables[$k]]);
                        $middle = $middle . $_POST[$variables[$k]];
                    }
                    $insert .= '"' . $variables[$k] . '":"' . $middle . '",';
                    $combineInsert = $insert;
                }
            }
        }

        //$parameter = implode("," , $paralist);
        $parameter = '{' . substr($combineInsert,0,-1) . '}';


        //insert extra questions answers into parameter
        $paramter_response = \DB::table('parameter')->insert(
                ['pid' => $participant_id, 'year' => $year, 'extra' => $parameter]
        );

//        $careerplan = $_POST['careerplan']; //array
//        $cs_areasofinterest = $_POST['cs_areasofinterest'];
//        $hobbies_interest = $_POST['hobbies_interest'];
//        $additionalcomments_questions = $_POST['additionalcomments_questions'];


//        return view('mentorapp',compact('email','studentnum','givenname', 'familyname', 'phone', 'phonealt', 'birthyear',
//            'additionalcomments_avail', 'mentorgender', 'programofstudy', 'programofstudy_other', 'yearofstudy', 'participation',
//            'coop', 'cs_areasofinterest', 'hobbies_interest', 'additionalcomments_questions', 'course', 'gender', 'careerplan', 'day1', 'day2', 'day3'));



    }

    public function mentorToDB(){
        //all participants attributes
        $givenname = $_POST['givenname'];
        $familyname = $_POST['familyname'];
        $gender = $_POST['gender'];
        //kickoff
        $day1 = $_POST['day1'];
        $day2 = $_POST['day2'];
        $day3 = $_POST['day3'];
        $additionalcomments_avail = $_POST['additionalcomments_avail'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $phonealt = $_POST['phonealt'];
        $birthyear = $_POST['birthyear'];
        $studentgenderpref = $_POST['studentgenderpref'];
        $participation = $_POST['participation'];
        $year = date("Y"); //2015
        $month = date("m"); //02
        $date = date("d"); //01

        //determine if registering past a deadline
        $rawApp = \DB::table('mentorapp')->where('year',$year)->first();
        $rawDeadline = $rawApp['deadline'];
        $deadline = explode("-",$rawDeadline); //day, month, year
        if($year > $deadline[0]){
            $waitlist = 1;
        }elseif($month > $deadline[1]){
            $waitlist = 1;
        }elseif($date > $deadline[2]){
            $waitlist = 1;
        }else{
            $waitlist = 0;
        }

        //inserting into participant table
        $participant_id = \DB::table('participant')->insertGetId(
            array('First name' => $givenname, 'Family name' => $familyname,
                'gender' => $gender, 'kickoff' => $day1 . "," .  $day2 . "," . $day3 . "," . $additionalcomments_avail,
                'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
                'birth year' => $birthyear, 'genderpref' => $studentgenderpref,
                'past participation' => $participation, 'waitlist' => $waitlist, 'year' => $year)
        );

        //mentor only attributes
        $position = $_POST['position']; //array
        $yearsofcswork = $_POST['yearsofcswork'];
        $levelofeducation = $_POST['levelofeducation'];
        $cs_areasofinterest = $_POST['cs_areasofinterest'];

        $mentor_response = \DB::table('mentor')->insert(
                ['mid' => $participant_id, 'job' => $position, 'yearofcs' => $yearsofcswork,
                'edulvl' => $levelofeducation, 'field of interest' => $cs_areasofinterest]
        );

        //extra questions
        $newQuestions = [];

        //grabbing raw questions from database
        $year = date("Y");
        $rawMenApp = \DB::table('mentorapp')->where('year', $year)->first();
        $rawQuestion = $rawMenApp["extra"];
        if ($rawQuestion == null){
            $newQuestions = null;
        } else {
            $questions = explode('`', $rawQuestion);
            //([format|id|question|answerA,answerB,answerC],[format2|id2|question2|answer])
            foreach ($questions as $q){
                //(format,id,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        //split the questions into just the tags
        //such that we can use the tags to check if form submitted anything
        $variables = [];
        $countQ = count($newQuestions);
        for($i = 0; $i < $countQ; $i++){
            array_push($variables, $newQuestions[$i][1]);
        }

        //check if anything was posted for the extra's questions and grab the answers
        //$paralist = [];
        $insert = "";
        $countV = count($variables);

        for($k = 0; $k < $countV; $k++){
            if(isset($_POST[$variables[$k]])){
                if($_POST[$variables[$k]] != ""){
                    $middle = "";
                    if(count($_POST[$variables[$k]]) > 1){
                        $combineVariable = $_POST[$variables[$k]];
                        for($m = 1; $m < count($_POST[$variables[$k]]) ; $m++){
                            //array_push($paralist, $combineVariable[$m + 1]);
                            if($m == (count($_POST[$variables[$k]]) - 1)) {
                                $middle .= $combineVariable[$m];
                            }else{
                                $middle .= $combineVariable[$m] . ',';
                            }
                        }
                    }else{
                        //array_push($paralist, $_POST[$variables[$k]]);
                        $middle = $middle . $_POST[$variables[$k]];
                    }
                    $insert .= '"' . $variables[$k] . '":"' . $middle . '",';
                    $combineInsert = $insert;
                }
            }
        }

        //$parameter = implode("," , $paralist);
        $parameter = '{' . substr($combineInsert,0,-1) . '}';

        //insert extra questions answers into parameter
        $paramter_response = \DB::table('parameter')->insert(
            ['pid' => $participant_id, 'year' => $year, 'extra' => $parameter]
        );


//        $employmentstatus = $_POST['employmentstatus']; //array
//        foreach($employmentstatus as $e){
//            $job = $e . ",";
//        }
//        $hobbies_interest = $_POST['hobbies_interest'];
//        $alumnus = $_POST['alumnus'];
//        $additionalcomments_questions = $_POST['additionalcomments_questions'];
//
//return view('studentapp',compact('email','givenname', 'familyname', 'phone', 'phonealt', 'gender','birthyear', 'studentgenderpref', 'day1', 'day2', 'day3',
//            'additionalcomments_avail', 'employmentstatus', 'yearsofcswork', 'levelofeducation', 'cs_areasofinterest', 'hobbies_interest',
//            'alumnus', 'additionalcomments_questions'));
   
}

    public function editForm()
    {
        //parameters
        /*
         * WHAT IT IS                                   VARIABLE NAME       POSSIBLE CHOICES FOR ANSWER
         * -------------------------------------------------------------------------------------------------
         * Determine if student or mentor app           'status'            (student, mentor)
         *
         * Determine the kickoff nights                 'kickoff'           (day1,day2,dayn)
         *
         * Determine the program of study               'program'           (pro1,pro2,pron) only for student
         *
         * deadline                                     'deadline'          (YYYY-MM-DD)
         *
         * Determine which operation                    'operation[]'         (add, delete, update, new)
         *                                                                   add    :   adding new question
         *                                                                   delete :   deleting existing question
         *                                                                   update :   updating a existing question
         *                                                                   new    :   new application form for the new year
         *
         * actual fields of questions                   'question[]'        (checkbox|checkboxTest|CheckboxQuestion|A1,A2,A3       OR
         *                                                                   text|textTest|textQuestion        OR
         *                                                                   radio|radioTest|radioQuestion|radioMessage|option1,option2,option3|B1,B2,B3    OR
         *                                                                   select|selectTest|selectQuestion|C1,C2,C3     OR
         *                                                                   textarea|textareaTest|textareaQuestion)
         *
         *                                                                   General form of above is
         *                                                                   (format|html name|question to be asked|message?|options?|answers?)
         *                                                                   follow that format depending on which they request for
         *
         *
         * Everytime someone clicked ADD, DELETE, UPDATE you add that operation into 'operation[]', concurrently
         * the in 'question[]' please add what they edited/added so that means
         *
         * operation[1] and question[1] are related, 
         * ex. ADD text would look like
         * operation[1] = add
         * question[1] = text|textTest|textQuestion
        */
        $year = date("Y");
        if(isset($_POST['status'])){
            $status = $_POST['status'];
        }
        if(isset($_POST['kickoff'])){
            $kickoff = $_POST['kickoff'];
        }
        if(isset($_POST['program'])){
            $program = $_POST['program'];
        }
        if(isset($_POST['deadline'])){
            $deadline = $_POST['deadline'];
        }
        if(isset($_POST['operation'])){
            $operation = $_POST['operation'];
        }
        if(isset($_POST['question'])){
            $questions = $_POST['question'];
        }
        //check if creating new application form, else, grab current form and do operation
        if ($operation != "new") {
            if ($status == "student") {
                $rawApp = \DB::table('studentapp')->where('year', $year)->first();
                for ($i = 0; $i < count($operation); $i++) {
                    //grab raw application for status provided
                    switch ($operation) {
                        case "add":
                        // TODO: check if already existing tag, if so, echo failure
                            $rawApp['extra'] .= $questions[$i];
                            $response = \DB::table('studentapp')->where('sappid', $rawApp['sappid'])->update(array('extra' => $rawApp['extra']));
                            break;

                        case "delete":
                            $newExtra = str_replace($questions[$i] . ',', "" , $rawApp['extra']);
                            $newExtra = str_replace($questions[$i], "" , $rawApp['extra']);
                            $response = \DB::table('studentapp')->where('sappid', $rawApp['sappid'])->update(array('extra' => $newExtra));
                            break;

                        case "update":
                            $question = explode('|', $questions[$i]);
                            $splitRawApp = explode('`', $rawApp['extra']);
                            for($m = 0; $m < count($splitRawApp); $m++){
                                $extra = "";
                                $pos = strpos($splitRawApp[$m], $question[1]);
                                if ($pos !== false){
                                    $splitRawApp[$m] = $questions[$i];
                                }
                                $extra .= $splitRawApp[$m];
                                $newExtra = $extra;
                            }
                            $response = \DB::table('studentapp')->where('sappid', $rawApp['sappid'])->update(array('extra' => $newExtra));
                            break;
                    }
                }
            } else {
                $rawApp = \DB::table('mentorapp')->where('year', $year)->first();
                for ($i = 0; $i < count($operation); $i++) {
                    //grab raw application for status provided
                    switch ($operation) {
                        case "add":
                            $rawApp['extra'] .= $questions[$i];
                            $response = \DB::table('mentorapp')->where('mappid', $rawApp['mappid'])->update(array('extra' => $rawApp['extra']));
                            break;

                        case "delete":
                            $newExtra = str_replace($questions[$i] . ',', "" , $rawApp['extra']);
                            $newExtra = str_replace($questions[$i], "" , $rawApp['extra']);
                            $response = \DB::table('mentorapp')->where('mappid', $rawApp['mappid'])->update(array('extra' => $newExtra));
                            break;

                        case "update":
                            $question = explode('|', $questions[$i]);
                            $splitRawApp = explode('`', $rawApp['extra']);
                            for($m = 0; $m < count($splitRawApp); $m++){
                                $extra = "";
                                $pos = strpos($splitRawApp[$m], $question[1]);
                                if ($pos !== false){
                                    $splitRawApp[$m] = $questions[$i];
                                }
                                $extra .= $splitRawApp[$m];
                                $newExtra = $extra;
                            }
                            $response = \DB::table('mentorapp')->where('mappid', $rawApp['mappid'])->update(array('extra' => $newExtra));
                            break;
                    }
                }
            }
        }else{
            //TODO: ask for program and kickoff
            if($status == 'student'){
                $student_response = \DB::table('studentapp')->insertGetId(
                    ['program' => $program, 'kickoff' => $kickoff,
                     'year' => $year+1, 'deadline' => $deadline]);
            }else{
                // TODO: ask for kickoff
                $mentor_response = \DB::table('mentorapp')->insertGetId(
                    ['kickoff' => $kickoff, 'year' => $year+1, 'deadline' => $deadline]);
            }
        }


        //want to be able to add more questions

        //want to edit already existing questions

        //want to remove already existing question
        // return view('studentform');
        return view('mentorform');
    }


}

