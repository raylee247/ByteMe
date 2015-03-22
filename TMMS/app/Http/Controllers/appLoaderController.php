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
        $year = date("Y");
        return View('appEdit')->with('year', $year);
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
        $rawCourse = $rawApp["courses"];
        $course = explode("," , $rawCourse);
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

        return View('appEdit')->with('course', $course)-> with ('program', $program)-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
	}


    /**
     * Grab mentor application form
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

        return View('appEdit')-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
    }



    /**
     *
     * insert application form answers into database
     * {"name":"bob","gender":"female","age":5}
     */
    public function studenttest(){

        $email = $_POST['email'];
        $studentnum = $_POST['studentnum'];
        $givenname = $_POST['givenname'];
        $familyname = $_POST['familyname']; 
        $phone = $_POST['phone'];
        $phonealt = $_POST['phonealt'];
        $gender = $_POST['gender'];
        $birthyear = $_POST['birthyear'];
        //kickoff
        $day1 = $_POST['day1'];
        $day2 = $_POST['day2'];
        $day3 = $_POST['day3'];
        $additionalcomments_avail = $_POST['additionalcomments_avail'];
        $mentorgender = $_POST['mentorgender'];
        $programofstudy = $_POST['programofstudy'];
        $programofstudy_other = $_POST['programofstudy_other'];
        $yearofstudy = $_POST['yearofstudy'];
        $participation = $_POST['participation'];
        $coop = $_POST['coop'];
        $course = $_POST['course'];
        $careerplan = $_POST['careerplan'];
        $cs_areasofinterest = $_POST['cs_areasofinterest'];
        $hobbies_interest = $_POST['hobbies_interest'];
        $additionalcomments_questions = $_POST['additionalcomments_questions'];


        return view('mentorapp',compact('email','studentnum','givenname', 'familyname', 'phone', 'phonealt', 'birthyear', 
            'additionalcomments_avail', 'mentorgender', 'programofstudy', 'programofstudy_other', 'yearofstudy', 'participation',
            'coop', 'cs_areasofinterest', 'hobbies_interest', 'additionalcomments_questions', 'course', 'gender', 'careerplan', 'day1', 'day2', 'day3'));
    }

    public function mentortest(){
        $email = $_POST['email'];
        $givenname = $_POST['givenname'];
        $familyname = $_POST['familyname']; 
        $phone = $_POST['phone'];
        $phonealt = $_POST['phonealt'];
        $gender = $_POST['gender'];
        $birthyear = $_POST['birthyear'];
        $studentgenderpref = $_POST['studentgenderpref'];
        //kickoff
        $day1 = $_POST['day1'];
        $day2 = $_POST['day2'];
        $day3 = $_POST['day3'];
        $additionalcomments_avail = $_POST['additionalcomments_avail'];
        $employmentstatus = $_POST['employmentstatus'];
        $yearsofcswork = $_POST['yearsofcswork'];
        $levelofeducation = $_POST['levelofeducation'];
        $cs_areasofinterest = $_POST['cs_areasofinterest'];
        $hobbies_interest = $_POST['hobbies_interest'];
        $alumnus = $_POST['alumnus'];
        $additionalcomments_questions = $_POST['additionalcomments_questions'];

return view('studentapp',compact('email','givenname', 'familyname', 'phone', 'phonealt', 'gender','birthyear', 'studentgenderpref', 'day1', 'day2', 'day3',
            'additionalcomments_avail', 'employmentstatus', 'yearsofcswork', 'levelofeducation', 'cs_areasofinterest', 'hobbies_interest', 
            'alumnus', 'additionalcomments_questions'));
   
}
}

