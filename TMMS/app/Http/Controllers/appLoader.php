<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class appLoader extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
    {
        $year = date("Y");
        return View('appEdit')->with('year', $year);
    }

	/**
	 * Grab student application form
	 *
	 * @return Response
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
     * @return Response
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
                //(format,question,answers)
                $q = explode('|', $q);
                array_push($newQuestions, $q);
            }
        }

        return View('appEdit')-> with ('kickoff', $kickoff)-> with ('questions', $newQuestions);
    }



    /**TODO: CHANGE DB SO THAT IT AUTO CREATES NEW TABLE EVERY YEAR
     *
     *
     *
     *
     */
}
