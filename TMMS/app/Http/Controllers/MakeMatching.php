<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\MatchGenerator;

//start_session();
//to get the priority array from weighted parameters page
// $weight = $_SESSION['weight'];
//to get the must array from weghted parameters page
//$must = $_SESSION['must'];

class MakeMatching extends Controller {

	protected $participants = array();


	public function generateMatchTest(){

        //comes in as element[]=tag1&element[]=tag2
        $rawMust = $_POST['mustList'];
        $rawPriority = $_POST['priorityList'];

        //turns into tag&tag
        $eleMust = str_replace("element[]=", "", $rawMust);
        $elePriority = str_replace("element[]=", "", $rawPriority);

        //array(tag,tag)
        $must = explode('&', $eleMust);
        $priority = explode('&',$elePriority);


        //TODO not sure what you are doing here!

        set_time_limit(3600);
        $must = array("KickOffAvailibility");
        $priority = array("interest");
        print("going into matchGenerator\n\n");
        $generator = new MatchGenerator($must, $priority);
        //TODO ROUTE THIS SHIT YOURSELF WILLIAM
        echo $generator->generate();
        return 0;

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function loadParameters()
	{
        $year = date("Y");
        $rawStuApp = \DB::table('studentapp')->where('year', $year)->first();
        $rawMenApp = \DB::table('mentorapp')->where('year', $year)->first();

        $stuTag = [];
        $menTag = [];

        $stuCombineExtra = explode("`",$rawStuApp['extra']);
        for($i = 0; $i < count($stuCombineExtra); $i++){
            $stuExtra = explode('|', $stuCombineExtra[$i]);
            array_push($stuTag, $stuExtra[1]);
        }

        $MenCombineExtra = explode("`",$rawMenApp['extra']);
        for($i = 0; $i < count($MenCombineExtra); $i++){
            $menExtra = explode('|', $MenCombineExtra[$i]);
            array_push($menTag, $menExtra[1]);
        }

        $formParameters = array_intersect($stuTag, $menTag);


        $csvParameterStudent= \DB::table('senior')
                            ->join('participant', 'senior.sid', '=', 'participant.pid')
                            ->join('parameter', 'senior.sid', '=', 'parameter.pid')->where('participant.year',$year)
                            ->select('extra')->first();

        $csvParameterMentor= \DB::table('mentor')
                            ->join('participant', 'mentor.mid', '=', 'participant.pid')
                            ->join('parameter', 'mentor.mid', '=', 'parameter.pid')->where('participant.year',$year)
                            ->select('extra')->first();

        $student = json_decode($csvParameterStudent['extra']);
        $mentor = json_decode($csvParameterMentor['extra']);

        $studentTag = [];
        $mentorTag = [];

        foreach($student as $skey => $svalue){
            if(($skey != "SID") && ($skey != "Time") && ($skey != "Draft")) {
                array_push($studentTag, $skey);
            }
        }

        foreach($mentor as $mkey => $mvalue){
            if(($mkey != "SID") && ($mkey != "Time") && ($mkey != "Draft")) {
                array_push($mentorTag, $mkey);
            }
        }

        $csvParameters = array_intersect($studentTag, $mentorTag);

        $parameter = array_merge($formParameters, $csvParameters);

		return view('weighting')->with('parameter', $parameter);
	}



}
