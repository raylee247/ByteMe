<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\MatchGenerator;
use App\Services\KickOffMatch;

//start_session();
//to get the priority array from weighted parameters page
// $weight = $_SESSION['weight'];
//to get the must array from weghted parameters page
//$must = $_SESSION['must'];

class MakeMatching extends Controller {




	public function generateMatchTest(){
        set_time_limit(3600);
        $must = array("kickoff");
        $priority = array("EmploymentStatus", "interest");
        print("going into matchGenerator\n\n");
        $generator = new MatchGenerator($must, $priority);
        $generator->generate_all();
        $avgSat = array_sum($result_ids)/count($result_ids);
        $median = array_median($result_ids);
        $result_names = $generator->toName($result_ids);
        $result_unmatch = $generator->get_unmatches($result_ids);
        var_dump($result_unmatch);

        return view('matchresult', compact('must','priority','avgSat', 'median',
                                            'result_ids','result_names',
                                            'result_unmatch'));


	}

	public function generateKickoff(){
		//set_time_limit(3600);
		$kickoffMax = 50;
		$maxMentor = 1;
		$kickoffs = array("2015-09-24","2015-09-25","2015-10-02");
		$generator = new KickOffMatch($kickoffs, $kickoffMax, $maxMentor);
		print("\n\ngoing into generate\n\n");
		echo $generator->generate();
		return 0;
	}

    public function insert_result_to_DB(){
        $must = unserialize(base64_decode($_POST['must']));
        $priority = unserialize(base64_decode($_POST['priority'])) ;
        $avgSat = unserialize(base64_decode($_POST['avgSat']));
        $median = unserialize(base64_decode($_POST['median']));
        $result_ids = unserialize(base64_decode($_POST['result_ids']));
        $result_names = unserialize(base64_decode($_POST['result_names']));
        $result_unmatch = unserialize(base64_decode($_POST['result_unmatch']));

        $mentors = unserialize(base64_decode($_POST['mentors']));
        $seniors = unserialize(base64_decode($_POST['seniors']));
        $juniors = unserialize(base64_decode($_POST['juniors']));

        $trioCount = unserialize(base64_decode($_POST['trioCount']));
        $unmatchCount = unserialize(base64_decode($_POST['unmatchCount']));
        $matchname = $_POST['matchname'];

        \DB::table('weighting')->insert(
                    ['must' => implode(",", $must),
                     'helpful' => implode(",", $priority),
                     'name' => $matchname,
                     'avgSat' => $avgSat,
                     'median' => $median
                    ]);
        $wid = \DB::table('weighting')->where('must', implode(",", $must))
                                            ->where('helpful', implode(",", $priority))
                                            ->where('name' , $matchname)
                                            ->pluck('wid');
        
        foreach (array_keys($result_ids) as $key => $value) {
            // echo "<p>" . $value . " : ". $result[$value]  ."</p>";
            $value_array = explode(",", $value);
            $m = $value_array[0];
            $s = $value_array[1];
            $j = $value_array[2];

            \DB::table('trioMatching')->insert(
                    ['wid' => $wid,
                     'mentor' => $m,
                     'senior' => $s,
                     'junior' => $j,
                    ]
                );
        }


        $Response =  \DB::table('weighting')->get();

        return view('savedmatches', compact('Response'));
    }
    public function refreshSavedMatches(){
        if(isset($_POST)){
            foreach ($_POST as $key => $value) {
               if (strpos($key, "rename")){
                    $target_wid = $value;
                    \DB::table('weighting')
                        ->where('wid', $value)
                        ->update(array('name' => $_POST['rename']));
               }
            }
        }
        $Response =  \DB::table('weighting')->get();

        return view('savedmatches', compact('Response'));
    }

    public function refreshMakeMatching(){
        $must = unserialize(base64_decode($_POST['must']));
        $priority = unserialize(base64_decode($_POST['priority'])) ;
        $avgSat = unserialize(base64_decode($_POST['avgSat']));
        $median = unserialize(base64_decode($_POST['median']));
        $result_ids = unserialize(base64_decode($_POST['result_ids']));
        $result_names = unserialize(base64_decode($_POST['result_names']));
        $result_unmatch = unserialize(base64_decode($_POST['result_unmatch']));

        $mentors = unserialize(base64_decode($_POST['mentors']));
        $seniors = unserialize(base64_decode($_POST['seniors']));
        $juniors = unserialize(base64_decode($_POST['juniors']));

        $trioCount = unserialize(base64_decode($_POST['trioCount']));
        $unmatchCount = unserialize(base64_decode($_POST['unmatchCount']));

        if(isset($_POST['pidToWaitList'])){
            \DB::table('participant')
                ->where('pid', $_POST['pidToWaitList'])
                ->update(array('waitlist' => 1));
            $temp = array();
            foreach ($result_unmatch as $key => $value) {
                $value_clone = $value; 
                if($value_clone['pid'] == $_POST['pidToWaitList']){
                    $value_clone['waitlist'] = 1;
                }
                $temp[$key] = $value_clone;
            }

            $result_unmatch = $temp;
        }elseif(isset($_POST['Undo'])){
            \DB::table('participant')
                ->where('pid', $_POST['Undo'])
                ->update(array('waitlist' => 0));
            $temp =array();
            foreach ($result_unmatch as $key => $value) {
                $value_clone = $value; 
                if($value['pid'] == $_POST['Undo']){
                    $value_clone['waitlist'] = 0;
                }
                $temp[$key] = $value_clone;
            }
            $result_unmatch = $temp;
        }

        return view('matchresult', compact( 'mentors', 'seniors', 'juniors',
                                            'must','priority','avgSat', 'median','trioCount', 'unmatchCount',
                                            'result_ids','result_names',
                                            'result_unmatch'));
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
        // var_dump($must);

        //TODO not sure what you are doing here!

        set_time_limit(3600);
        print("going into matchGenerator\n\n");
        $generator = new MatchGenerator($must, $priority);
        $result_ids =  $generator->generate_all();
        // result with [ match => satisfaction]
        $avgSat = array_sum($result_ids)/count($result_ids);
        $median = $this->array_median($result_ids);
        $result_names = $generator->toName($result_ids);
        $result_unmatch = $generator->get_unmatches($result_ids);
        $trioCount = count($result_ids);
        $unmatchCount = count($result_unmatch);

        $mentors = $generator->getAvalMentors();
        $seniors = $generator->getAvalSeniors();
        $juniors = $generator->getAvalJuniors();

         return view('matchresult', compact( 'mentors', 'seniors', 'juniors',
                                            'must','priority','avgSat', 'median','trioCount', 'unmatchCount',
                                            'result_ids','result_names',
                                            'result_unmatch'));

    }

    public function array_median($array) {
      // perhaps all non numeric values should filtered out of $array here?
      $iCount = count($array);
      if ($iCount == 0) {
        throw new DomainException('Median of an empty array is undefined');
      }
      // if we're down here it must mean $array
      // has at least 1 item in the array.
      $middle_index = floor($iCount / 2);
      sort($array, SORT_NUMERIC);
      $median = $array[$middle_index]; // assume an odd # of items
      // Handle the even case by averaging the middle 2 items
      if ($iCount % 2 == 0) {
        $median = ($median + $array[$middle_index - 1]) / 2;
      }
      return $median;
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
