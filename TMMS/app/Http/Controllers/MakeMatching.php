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




	public function generateMatchTest(){

        //comes in as element[]=tag1&element[]=tag2


        set_time_limit(3600);
        $must = array("kickoff");
        $priority = array("EmploymentStatus", "interest");
        print("going into matchGenerator\n\n");
        $generator = new MatchGenerator($must, $priority);
        $generator->generate();
        return 0;

	}

    public function generateMatch(){

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
        print("going into matchGenerator\n\n");
        $generator = new MatchGenerator($must, $priority);
        $generator->generate_all();
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
		return view('weighting')->with('stuTag', $stuTag)->with('menTag', $menTag);
	}



}
