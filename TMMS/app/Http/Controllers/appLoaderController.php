<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class appLoaderController extends Controller {

    protected $test;


    /*

        Function: grabStudentApp

        Grabs the student application form from the database to be displayed on the view.

        Parameters:
        none

        Returns:
        The current years application is sent to the view to be displayed

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

        //deadline
        $deadline = $rawApp["deadline"];

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

        return View('studentapp')-> with ('program', $program)-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions)->with('deadline', $deadline);;
	}


    /*

       Function: grabStudentAppEdit

       Grabs the student application form from the database to be displayed on the view such that they can be edited

       Parameters:
       none

       Returns:
       The current years application is sent to the view to be displayed

   */
    public function grabStudentAppEdit()
    {
        //grab application form from DB for current year
        if(isset($_POST['year'])){
            $year = $_POST['year'];
        }else {
            $year = date("Y");
        }
        $rawApp = \DB::table('studentapp')->where('year', $year)->first();

        //return $rawApp;

        //break into different elements to get the text for HTML

        //Courses offered @ UBC student may have taken
//        $rawCourse = $rawApp["courses"];
//        $course = explode("," , $rawCourse);
//        foreach($course as $c){
//            echo $c . "<br>";
//        }
        //gets different years that have applications
        $test = \DB::table('studentapp')->select('year')->get();
        $listOfYear = [];
        for($i = 0;$i < count($test); $i++){
            array_push($listOfYear, $test[$i]['year']);
        }

        //Current programs offered at UBC that have affiliation with CPSC
        $rawProgram =$rawApp["program"];
        $program = explode("," , $rawProgram);

        //Current dates for planned Kickoff night
        $rawKickoff = $rawApp["kickoff"];
        $kickoff = explode(",", $rawKickoff);

        //deadline
        $deadline = $rawApp["deadline"];

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

        return View('studentform')-> with ('program', $program)-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions)
            ->with('years', $listOfYear) ->with('deadline', $deadline)->with('year', $year);
    }

    /*

       Function: grabMentorApp

       Grabs the mentor application form from the database to be displayed on the view

       Parameters:
       none

       Returns:
       The current years application is sent to the view to be displayed

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

        //deadline
        $deadline = $rawApp["deadline"];

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

        return View('mentorapp')-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions)->with('deadline', $deadline);;
    }


    /*

       Function: grabMentorAppEdit

       Grabs the mentor application form from the database to be displayed on the view such that they can be edited

       Parameters:
       none

       Returns:
       The current years application is sent to the view to be displayed

   */
    public function grabMentorAppEdit()
    {
        //grab application form from DB for current year
        if(isset($_POST['year'])){
            $year = $_POST['year'];
        }else {
            $year = date("Y");
        }
        $rawApp = \DB::table('mentorapp')->where('year', $year)->first();

        //return $rawApp;

        //break into different elements to get the text for HTML

        //grabbing different years with applications
        $test = \DB::table('mentorapp')->select('year')->get();
        $listOfYear = [];
        for($i = 0;$i < count($test); $i++){
            array_push($listOfYear, $test[$i]['year']);
        }

        //Current dates for planned Kickoff night
        $rawKickoff = $rawApp["kickoff"];
        $kickoff = explode(",", $rawKickoff);

        //deadline
        $deadline = $rawApp["deadline"];

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

        return View('mentorform')-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions)
            ->with ('years', $listOfYear)->with('deadline', $deadline)->with('year', $year);
    }


    /*

       Function: studentToDB

       Takes all required fields (from the view) and turns them into a JSON object which holds all the
       answered requirements. Uploading the JSON object into the database, as well as all the other student information.
       Will also determine if a student is a senior or junior based on if they have completed all the required
       second year courses (CPSC 210,221,213)

       Parameters:
       none

       Returns:
       Success or Fail page depending if the applicant is successfully placed into the database

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
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $phonealt = $_POST['phonealt'];
        $birthyear = $_POST['birthyear'];
        $mentorgender = $_POST['mentorgender'];
        $participation = $_POST['participation'];
        $year = date("Y"); //2015
        $month = date("m"); //02
        $date = date("d"); //01
        $cs_areasofinterest = $_POST['cs_areasofinterest'];

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
        //CHECK IF ALREADY IN PARTICIPANT TABLE, MEANING EMAIL ALREADY IN BUT DIFFERENT YEAR

        $pidYear = \DB::table('participant')->select('pid', 'year')->where('email', $email)->get();

        if(count($pidYear) > 0){
            // if($pidYear[0]['year'] == $year){
            //     $participant_response = \DB::table('participant')->where('year', $year)->where('email', $email)
            //         ->update(
            //             ['First name' => $givenname, 'Family name' => $familyname,
            //             'gender' => $gender, 'kickoff' => $day1 . "," . $day2 . "," . $day3,
            //             'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
            //             'birth year' => $birthyear, 'genderpref' => $mentorgender,
            //             'past participation' => "Yes", 'waitlist' => $waitlist, 'year' => $year, 'interest' => $cs_areasofinterest]
            //         );
            //     //update
            if($pidYear[0]['year'] == $year){
                $message = "Email already in system";
                return View('failure')->with('message', $message);
            }else{
                //grab PID and insert into table with new entry, but same PID
                $participant_response = \DB::table('participant')->insert(
                    ['pid' => $pidYear[0]['pid'], 'First name' => $givenname, 'Family name' => $familyname,
                    'gender' => $gender, 'kickoff' => $day1 . "," . $day2 . "," . $day3,
                    'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
                    'birth year' => $birthyear, 'genderpref' => $mentorgender,
                    'past participation' => $participation, 'waitlist' => $waitlist, 'year' => $year, 'interest' => $cs_areasofinterest]
                );
                $participant_id = $pidYear[0]['pid'];
            }
        }else { //make new Participant
            //inserting into participant table
            $participant_id = \DB::table('participant')->insertGetId(
                ['First name' => $givenname, 'Family name' => $familyname,
                'gender' => $gender, 'kickoff' => $day1 . "," . $day2 . "," . $day3,
                'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
                'birth year' => $birthyear, 'genderpref' => $mentorgender,
                'past participation' => $participation, 'waitlist' => $waitlist, 'year' => $year, 'interest' => $cs_areasofinterest]
            );
        }
        //student only
        $studentnum = $_POST['studentnum'];
        $yearofstudy = $_POST['yearofstudy'];
        $programofstudy = $_POST['programofstudy'];
        $programofstudy_other = $_POST['programofstudy_other'];
        $courses = $_POST['course']; //array
        $csid = $_POST['csid'];
        $coop = $_POST['coop'];


        //detemine if it is a senior or junior student (determined if they took all the listed CPSC courses)
        //insert accordingly, with sid OR jid = participant_id
        if(count($courses)==4){
            $course = $courses[1] . "," . $courses[2] . "," . $courses[3];
            $senior_response = \DB::table('senior')->insert(
                    ['sid' => $participant_id, 'studentNum' => $studentnum, 'yearStand' => $yearofstudy,
                    'programOfStudy' => $programofstudy . $programofstudy_other, 'courses' => $course, 'csid' => $csid,
                    'coop' => $coop]
            );
        }elseif(count($courses)>1){
            for($jk = 0; $jk < count($courses); $jk++){
                $course .= $courses[$jk + 1];
            }
            $junior_response = \DB::table('junior')->insert(
                    ['jid' => $participant_id, 'studentNum' => $studentnum, 'yearStand' => $yearofstudy,
                    'programOfStudy' => $programofstudy . $programofstudy_other, 'courses' => $course, 'csid' => $csid,
                    'coop' => $coop]
            );
        }else{
            $course = "";
            $junior_response = \DB::table('junior')->insert(
                    ['jid' => $participant_id, 'studentNum' => $studentnum, 'yearStand' => $yearofstudy,
                    'programOfStudy' => $programofstudy . $programofstudy_other, 'courses' => $course, 'csid' => $csid,
                    'coop' => $coop]
                    );
        }
        
        //extra questions
        $newQuestions = [];
        $additionalcomments_avail = "";
        if(isset($_POST['additionalcomments_avail'])){
            $additionalcomments_avail = $_POST['additionalcomments_avail'];
        }

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
        $parameter = '{' . substr($combineInsert,0,-1) . '"Additional comments re availability":"' . $additionalcomments_avail .'"' . '}';


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


        $message = "Added to the system!";
        return View('success')->with('message',$message);

    }

    /*

       Function: mentorToDB

       Takes all required fields (from the view) and turns them into a JSON object which holds all the
       answered requirements. Uploading the JSON object into the database, as well as all the other mentor information.

       Parameters:
       none

       Returns:
       Success or Fail page depending if the applicant is successfully placed into the database

   */
    public function mentorToDB(){
        //all participants attributes
        $givenname = $_POST['givenname'];
        $familyname = $_POST['familyname'];
        $gender = $_POST['gender'];
        //kickoff
        $day1 = $_POST['day1'];
        $day2 = $_POST['day2'];
        $day3 = $_POST['day3'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $phonealt = $_POST['phonealt'];
        $birthyear = "";
        if(isset($_POST['birthyear'])){
            $birthyear = $_POST['birthyear'];
        }
        $studentgenderpref = $_POST['studentgenderpref'];
        $participation = $_POST['participation'];
        $year = date("Y"); //2015
        $month = date("m"); //02
        $date = date("d"); //01
        $cs_areasofinterest = $_POST['cs_areasofinterest'];

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

        //CHECK IF ALREADY IN PARTICIPANT TABLE, MEANING EMAIL ALREADY IN BUT DIFFERENT YEAR

        $pidYear = \DB::table('participant')->select('pid', 'year')->where('email', $email)->get();

        if(count($pidYear) > 0) {
            // if ($pidYear[0]['year'] == $year) {
            //     $participant_repsonse = \DB::table('participant')->where('year', $year)->where('email', $email)
            //         ->update(
            //             ['First name' => $givenname, 'Family name' => $familyname,
            //                 'gender' => $gender, 'kickoff' => $day1 . "," . $day2 . "," . $day3,
            //                 'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
            //                 'birth year' => $birthyear, 'genderpref' => $studentgenderpref,
            //                 'past participation' => "Yes", 'waitlist' => $waitlist, 'year' => $year, 'interest' => $cs_areasofinterest]
            //         );
            //     //update
             if($pidYear[0]['year'] == $year){
                $message = "Email already in system";
                return View('failure')->with('message', $message);
            }else{
                //grab PID and insert into table with new entry, but same PID
                $participant_repsonse = \DB::table('participant')->insert(
                    ['pid' => $pidYear[0]['pid'], 'First name' => $givenname, 'Family name' => $familyname,
                        'gender' => $gender, 'kickoff' => $day1 . "," . $day2 . "," . $day3,
                        'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
                        'birth year' => $birthyear, 'genderpref' => $studentgenderpref,
                        'past participation' => $participation, 'waitlist' => $waitlist, 'year' => $year, 'interest' => $cs_areasofinterest]
                );
            }
        }else {
            //inserting into participant table
            $participant_id = \DB::table('participant')->insertGetId(
                array('First name' => $givenname, 'Family name' => $familyname,
                    'gender' => $gender, 'kickoff' => $day1 . "," . $day2 . "," . $day3,
                    'email' => $email, 'phone' => $phone, 'phone alt' => $phonealt,
                    'birth year' => $birthyear, 'genderpref' => $studentgenderpref,
                    'past participation' => $participation, 'waitlist' => $waitlist, 'year' => $year, 'interest' => $cs_areasofinterest)
            );
        }
        //mentor only attributes
        $position = $_POST['position']; //array
        $yearsofcswork = $_POST['yearsofcswork'];
        $levelofeducation = $_POST['levelofeducation'];
        $company = "";
        if(isset($_POST['company'])){
            $company = $_POST['company'];
        }

        $mentor_response = \DB::table('mentor')->insert(
                ['mid' => $participant_id, 'job' => $position, 'yearofcs' => $yearsofcswork,
                'edulvl' => $levelofeducation, 'company' => $company]
        );

        //extra questions
        $newQuestions = [];
        $additionalcomments_avail = "";
        if(isset($_POST['additionalcomments_avail'])){
            $additionalcomments_avail = $_POST['additionalcomments_avail'];
        }
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
        $parameter = '{' . substr($combineInsert,0,-1) . '"Additional comments re availability":"' . $additionalcomments_avail .'"' . '}';

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
   
        $message = "Added to the system!";
        return View('success')->with('message',$message);
}

    /*

       Function: editForm

       Determines whether a question is added, edited, or deleted from the application form (mentor or student) and updates the
       database. Can also create a new application form for the next year, as well as set the deadline/kickoff nights.

       Parameters:
       none

       Returns:
       Updated application form.

   */
    public function editForm()
    {
        //passed in from view
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
         * Determine which operation                    'operation'         (add, delete, update, new)
         *                                                                   add    :   adding new question
         *                                                                   delete :   deleting existing question
         *                                                                   update :   updating a existing question
         *                                                                   new    :   new application form for the new year
         *
         * actual fields of questions                   'question'        (checkbox|checkboxTest|CheckboxQuestion|A1,A2,A3       OR
         *                                                                   text|textTest|textQuestion        OR
         *                                                                   radio|radioTest|radioQuestion|radioMessage|option1,option2,option3|B1,B2,B3    OR
         *                                                                   select|selectTest|selectQuestion|C1,C2,C3     OR
         *                                                                   textarea|textareaTest|textareaQuestion)
         *
         *                                                                   General form of above is
         *                                                                   (format|html name|question to be asked|message?|options?|answers?)
         *                                                                   follow that format depending on which they request for
         *
         * year of editting application                 'year'              (YYYY)
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
        $year = $_POST['year'];
        $status = $_POST['status'];
        if(isset($_POST['kickoff'])) {
            $kickoff = $_POST['kickoff'];
            if ($status == 'student') {
                $deadlineResponse = \DB::table('studentapp')->where('year', $year)->update(array('kickoff' => $kickoff));
                return $this->grabStudentAppEdit();
            } else {
                $deadlineResponse = \DB::table('mentorapp')->where('year', $year)->update(array('kickoff' => $kickoff));
                return $this->grabMentorAppEdit();
            }
        }
        if(isset($_POST['program'])){
            $program = $_POST['program'];
                $deadlineResponse = \DB::table('studentapp')->where('year', $year)->update(array('program' => $program));
                return $this->grabStudentAppEdit();
        }
        if(isset($_POST['dlyear']) && isset($_POST['dlmonth']) && isset($_POST['dlday'])){
            $dlyear = $_POST['dlyear'];
            $dlmonth = $_POST['dlmonth'];
            $dlday = $_POST['dlday'];
            $deadline = $dlyear . "-" . $dlmonth . "-" . $dlday;
            if($status == 'student'){
                $deadlineResponse = \DB::table('studentapp')->where('year', $year)->update(array('deadline' => $deadline));
                return $this->grabStudentAppEdit();
            }else{
                $deadlineResponse = \DB::table('mentorapp')->where('year', $year)->update(array('deadline' => $deadline));
                return $this->grabMentorAppEdit();

            }

        }
        if(isset($_POST['operation'])) {
            $operation = $_POST['operation'];


            //check if creating new application form, else, grab current form and do operation
            if ($operation != "new") {
                //grab the question being added/changed
                if ($status == "student") {
                    $rawApp = \DB::table('studentapp')->where('year', $year)->first();

                    //grab raw application for status provided
                    switch ($operation) {
                        case "add":
                            $question = $this->getAddQuestion();
                            $splitQuestion = explode("|", $question);
                            $questionTag = $splitQuestion[1];
                            if (strpos($rawApp['extra'], $questionTag) !== false) {
                                $message = "Tag already exists, please choose another one.";
                                return view('failure')->with('message', $message);
                            } else {
                                if(strlen($rawApp['extra']) > 1) {
                                    $rawApp['extra'] .= "`" . $question;
                                } else{
                                    $rawApp['extra'] .= $question;
                                }
                                $response = \DB::table('studentapp')->where('sappid', $rawApp['sappid'])->update(array('extra' => $rawApp['extra']));
                            }
                            break;

                        case "delete":
                            $question = $this->getQuestion();
                            $questionFirst = $question . "`";
                            $questionLast = "`" . $question;


                            /*
                             * q
                             *
                             * q`
                             * `q
                             *
                             * q``e
                             *
                             *
                             */

                            if(strlen(str_replace($questionFirst, "", $rawApp['extra'])) < strlen($rawApp['extra'])){
                                $newExtra = str_replace($questionFirst, "", $rawApp['extra']);
                            } elseif (strlen(str_replace($questionLast, "", $rawApp['extra'])) < strlen($rawApp['extra'])) {
                                $newExtra = str_replace($questionLast, "", $rawApp['extra']);
                            } else{
                                $newExtra = "";
                            }
                            $response = \DB::table('studentapp')->where('sappid', $rawApp['sappid'])->update(array('extra' => $newExtra));
                            break;

                        case "update":
                            $question = $this->getQuestion();
                            $questionSplit = explode('|', $question); //FORMAT|ID|QUESTION... => (FORMAT, ID, QUESTION, ...)
                            $splitRawApp = explode('`', $rawApp['extra']); //Q1`Q2`Q3... => (Q1, Q2, Q3, ...)
                            $extra = "";
                            for ($m = 0; $m < count($splitRawApp); $m++) {
                                $pos = strpos($splitRawApp[$m], $questionSplit[1]); //is ID in Qi
                                if ($pos !== false) {  //true
                                    $splitRawApp[$m] = $question;  //Qi = question
                                }
                                $extra .= $splitRawApp[$m] . "`";
                                $newExtra = $extra;
                            }
                            $newExtra = substr($newExtra,0,-1);
                            $response = \DB::table('studentapp')->where('sappid', $rawApp['sappid'])->update(array('extra' => $newExtra));
                            break;
                    }
                    return $this->grabStudentAppEdit();
                } else {
                    $rawApp = \DB::table('mentorapp')->where('year', $year)->first();

                    //grab raw application for status provided
                    switch ($operation) {
                        case "add":
                            $question = $this->getAddQuestion();
                            $splitQuestion = explode("|", $question);
                            $questionTag = $splitQuestion[1];
                            if (strpos($rawApp['extra'], $questionTag) !== false) {
                                $message = "Tag already exists, please choose another one.";
                                return view('failure')->with('message', $message);
                            } else {
                                if(strlen($rawApp['extra']) > 1) {
                                    $rawApp['extra'] .= "`" . $question;
                                } else{
                                    $rawApp['extra'] .= $question;
                                }
                                $response = \DB::table('mentorapp')->where('mappid', $rawApp['mappid'])->update(array('extra' => $rawApp['extra']));
                            }
                            break;

                        case "delete":
                            $question = $this->getQuestion();

                            $questionFirst = $question . "`";
                            $questionLast = "`" . $question;


                            /*
                             * q
                             *
                             * q`
                             * `q
                             *
                             * q``e
                             *
                             *
                             */

                            if(strlen(str_replace($questionFirst, "", $rawApp['extra'])) < strlen($rawApp['extra'])){
                                $newExtra = str_replace($questionFirst, "", $rawApp['extra']);
                            } elseif (strlen(str_replace($questionLast, "", $rawApp['extra'])) < strlen($rawApp['extra'])) {
                                $newExtra = str_replace($questionLast, "", $rawApp['extra']);
                            } else{
                                $newExtra = "";
                            }


//
//                            $newExtra = str_replace($question . "`", "", $rawApp['extra']);
//                            if(strlen($newExtra) == strlen($rawApp['extra'])) {
//                                $newExtra = str_replace("`" . $question, "", $rawApp['extra']);
//                            }
//                            elseif(strlen((str_replace($question . "`", "", $rawApp['extra'])) ==  strlen(str_replace("`" . $question, "", $rawApp['extra']))) && (strlen($newExtra = str_replace($question, "", $rawApp['extra'])) == 0) ) {
//                                $newExtra = "";
//                            }
                            $response = \DB::table('mentorapp')->where('mappid', $rawApp['mappid'])->update(array('extra' => $newExtra));
                            break;

                        case "update":
                            $question = $this->getQuestion();
                            $questionSplit = explode('|', $question); //FORMAT|ID|QUESTION... => (FORMAT, ID, QUESTION, ...)
                            $splitRawApp = explode('`', $rawApp['extra']); //Q1`Q2`Q3... => (Q1, Q2, Q3, ...)
                            $extra = "";
                            for ($m = 0; $m < count($splitRawApp); $m++) {
                                $pos = strpos($splitRawApp[$m], $questionSplit[1]); //is ID in Qi
                                if ($pos !== false) {  //true
                                    $splitRawApp[$m] = $question;  //Qi = question
                                }
                                $extra .= $splitRawApp[$m] . "`";
                                $newExtra = $extra;
                            }
                            $newExtra = substr($newExtra,0,-1);
                            $response = \DB::table('mentorapp')->where('mappid', $rawApp['mappid'])->update(array('extra' => $newExtra));
                            break;
                    }
                    return $this->grabMentorAppEdit();
                }
            } else {
                //default kickoff night and program from last year loaded into new year student app
                $kickoff = "3000-12-30";
                $year = date("Y");
                if ($status == 'student') {
                    $made = \DB::table('studentapp')->where('year', $year + 1)->get();
                    if(count($made)>0){
                        $message = "Form for next year already exist.";
                        return view('failure')->with('message', $message);
                    }else {
                        $program = \DB::table('studentapp')->select('program')->where('year', $year)->get();
                        $student_response = \DB::table('studentapp')->insertGetId(
                            ['program' => $program[0]['program'], 'kickoff' => $kickoff,
                                'year' => $year + 1, 'deadline' => $kickoff]);
                        return $this->grabStudentAppEdit();
                    }
                } else {
                    //default kickoff night into new year mentor app
                    $made = \DB::table('mentorapp')->where('year', $year + 1)->get();
                    if (count($made) > 0) {
                        $message = "Form for next year already exist.";
                        return view('failure')->with('message', $message);
                    } else {
                        $mentor_response = \DB::table('mentorapp')->insertGetId(
                            ['kickoff' => $kickoff, 'year' => $year + 1, 'deadline' => $kickoff]);
                        return $this->grabMentorAppEdit();
                    }
                }
            }
        }

    }

    /*

       Function: getQuestion

       Constructs questions into a string such that it can be deleted from the database

       Parameters:
       none

       Returns:
       A string of the question the user wants to delete

   */
    public function getQuestion(){

        $format = $_POST['questiontype'];
        switch($format){
            case "checkbox":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $answers = $_POST['answers'];

                $test = $format . "|" . $tag . "|" . $question . "|" . $answers;
                break;

            case "text":
                $tag = $_POST['tag'];
                $question = $_POST['question'];

                $test = $format . "|" . $tag . "|" . $question;
                break;

            case "radio":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $message = "";
                if(isset($_POST['message'])){
                    $message = $_POST['message'];
                }
                $options = $_POST['options'];
                $choices = $_POST['choices'];


                $test = $format . "|" . $tag . "|" . $question . "|" . $message . "|" .
                    $options ."|" . $choices;
                break;

            case "select":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $answers = $_POST['answers'];

                $test = $format . "|" . $tag . "|" . $question . "|" . $answers;
                break;

            case "textarea":
                $tag = $_POST['tag'];
                $question = $_POST['question'];

                $test = $format . "|" . $tag . "|" . $question;
                break;

            case "singleRadio":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $answers = $_POST['answers'];

                $test = $format . "|" . $tag . "|" . $question . "|" . $answers;
                break;
        }

        return $test;
    }

    /*

   Function: getAddQuestion

   Constructs questions into a string such that it can be added to the database

   Parameters:
   none

   Returns:
   A string of the question the user wants to add

*/
    public function getAddQuestion(){

        $format = $_POST['questiontype'];
        switch($format){
            case "checkbox":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $answers = $_POST['answers'];
                $test = $format . "|" . $tag[0] . "|" . $question[0] . "|" . $answers[0];
                break;
            case "text":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $test = $format . "|" . $tag[1] . "|" . $question[1];
                break;
            case "radio":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $message = "";
                if(isset($_POST['message'])){
                    $message = $_POST['message'];
                }
                $options = $_POST['options'];
                $choices = $_POST['choices'];
                $test = $format . "|" . $tag[2] . "|" . $question[2] . "|" . $message . "|" .
                    $options ."|" . $choices;
                break;
            case "select":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $answers = $_POST['answers'];
                $test = $format . "|" . $tag[3] . "|" . $question[3] . "|" . $answers[2];
                break;
            case "textarea":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $test = $format . "|" . $tag[4] . "|" . $question[4];
                break;
            case "singleRadio":
                $tag = $_POST['tag'];
                $question = $_POST['question'];
                $answers = $_POST['answers'];
                $test = $format . "|" . $tag[5] . "|" . $question[5] . "|" . $answers[3];
        }
        return $test;
    }


}

