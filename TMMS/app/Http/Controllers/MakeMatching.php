<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MatchGenerator;
use App\Services\KickOffMatch;

class MakeMatching extends Controller {


    /*
    Purpose:
    when the user chooses to save the result generated, takes the infromation from the 
    view and push them to two tables:
        weighting 
        trio-match 
    parameter:
        - none (method wise)
    expected $_POST
        - must 
        - priority 
        - average statisfaction rate
        - median
        - result_id
        - matchnames

    return 
        - redirect user to saved matches page to compare matches 
    */
    public function insert_result_to_DB(){
        $must = unserialize(base64_decode($_POST['must']));
        $priority = unserialize(base64_decode($_POST['priority'])) ;
        $avgSat = unserialize(base64_decode($_POST['avgSat']));
        $median = unserialize(base64_decode($_POST['median']));
        $result_ids = unserialize(base64_decode($_POST['result_ids']));
        $matchname = $_POST['matchname'];
        
        \DB::table('weighting')->insert(
                    ['must' => implode(",", $must),
                     'helpful' => implode(",", $priority),
                     'name' => $matchname,
                     'avgSat' => $avgSat,
                     'median' => $median,
                     'year' => date("Y")
                    ]);
        $wid = \DB::table('weighting')->where('must', implode(",", $must))
                                            ->where('helpful', implode(",", $priority))
                                            ->where('name' , $matchname)
                                            ->pluck('wid');
        
        foreach (array_keys($result_ids) as $key => $value) {
            $value_array = explode(",", $value);
            $m = $value_array[0];
            $s = $value_array[1];
            $j = $value_array[2];
            \DB::table('trioMatching')->insert(
                    ['wid' => $wid,
                     'mentor' => $m,
                     'senior' => $s,
                     'junior' => $j,
                     'satisfaction' => $result_ids[$value]
                    ]
                );
        }

        $Response =  \DB::table('weighting')->get();
        return view('savedmatches', compact('Response'));
    }
    /*
    Purpose:
    rename the selected match 
    parameter:
        - none (method wise)
    expected $_POST
        - rename 
    return 
        - saved match view
    */
    public function refreshSavedMatches(){
        if(isset($_POST['wid']) && isset($_POST['rename'])){
            \DB::table('weighting')
                ->where('wid', $_POST['wid'])
                ->update(array('name' => $_POST['rename']));       
        }elseif(isset($_POST['Deletewid'])){
            $check = \DB::table('weighting')->where('wid', '=', $_POST['Deletewid'])->get();
            if(($check[0]['setAsFinal'] == 1) && ($check[0]['year'] == date("Y"))){
                \DB::table('report')->where('year', '=', $check[0]['year'])->delete();
                \DB::table('kickoffgroup')->delete();
                \DB::table('kickoffresult')->delete();
            }
            
            \DB::table('weighting')->where('wid', '=', $_POST['Deletewid'])->delete();
            \DB::table('trioMatching')->where('wid', '=', $_POST['Deletewid'])->delete();         
        }
        $Response =  \DB::table('weighting')->get();
        return view('savedmatches', compact('Response'));
    }

    /*
    Purpose:
    refresh the page without recomputing the matching
    do some dabase connection upon user request (moving to waitlist)
    parameter:
        - none (method wise)
    expected $_POST
        - must 
        - priority 
        - average statisfaction rate
        - median
        - result_id
        - result_names
        - mentors
        - seniors
        - juniors 
        - trioCount
        - unmatchedCount
        - matchnames
    return 
        - matchresult view with same content 
    */
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

    /*
    Purpose:
    takes the parameter tag shown in the weighting page and trigger the matching logic
    parameter:
        - none (method wise)
    expected $_POST
        - mustList 
        - priorityList
    return 
        - redirect user to match result page to display result
    */
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
        // set_time_limit(3600);
        // print("going into matchGenerator\n\n");
        $generator = new MatchGenerator($must, $priority);
        $result_ids =  $generator->generate_all();
        // result with [ match => satisfaction]
        if(count($result_ids) > 0){
            $avgSat = array_sum($result_ids)/count($result_ids);
        }else{
            $avgSat = 0;
        }
        
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

    /*
    Purpose:
    recompute the match withot the specified manual match
    parameter:
        - none (method wise)
    expected $_POST
        - mentor 
        - senior
        - junior
    return 
        - matchresult page 
    */

    public function generateWithout(){
        // check if any value is empty
        $empty = 0;
        $manualMatches = array();
        $mentor_without = array();
        $senior_without = array();
        $junior_without = array();

        foreach ($_POST['mentor'] as $key => $value) {
            if($value == ""){
                $empty++;
            }else{
                $mid = explode(",", $value)[0];
                $mentor_without[] = $mid;
            }
        }
        foreach ($_POST['senior'] as $key => $value) {
            if($value == ""){
                $empty++;
            }else{
                $sid = explode(",", $value)[0];
                $senior_without[] = $sid;
            }
        }
        foreach ($_POST['junior'] as $key => $value) {
            if($value == ""){
                $empty++;
            }else{
                $jid = explode(",", $value)[0];
                $junior_without[] = $jid;
            }
        }


        if($empty > 0 && !count($_POST['mentor']) == 1){
            $message = "Please specifiy all of mentor, senior, and junior.\n
                        Press Go Back to re-submit.";
            return view('failure', compact('message'));
        }else{
            foreach ($mentor_without as $key => $value) {
                $match = implode(",", array($mentor_without[$key],$senior_without[$key],$junior_without[$key]));
                $manualMatches[$match] = null;
            }
        }

        $must = unserialize(base64_decode($_POST['must']));
        $priority = unserialize(base64_decode($_POST['priority'])) ;
        $generator = new MatchGenerator($must, $priority);
        $result_ids =  $generator->generate_without($mentor_without,$senior_without,$junior_without);
        // result with [ match => satisfaction]
        if(count($result_ids) > 0){
            $avgSat = array_sum($result_ids)/count($result_ids);
        }else{
            $avgSat = 0;
        }
        
        $median = $this->array_median($result_ids);
        $result_unmatch = $generator->get_unmatches($result_ids);
        $trioCount = count($result_ids);
        $unmatchCount = count($result_unmatch);

        $result_ids = array_merge($result_ids,$manualMatches);
        $result_names = $generator->toName($result_ids);

        $mentors = $generator->getAvalMentors();
        $seniors = $generator->getAvalSeniors();
        $juniors = $generator->getAvalJuniors();
        return view('matchresult', compact( 'mentors', 'seniors', 'juniors',
                                            'must','priority','avgSat', 'median','trioCount', 'unmatchCount',
                                            'result_ids','result_names',
                                            'result_unmatch'));
    }

    /*
    Purpose:
    compute the midian value of given array
    parameter:
        - array 
    return 
        - the midian value of the given aarray
    */
    public function array_median($array) {
      // perhaps all non numeric values should filtered out of $array here?
      $iCount = count($array);
      if ($iCount == 0) {
        return 0;
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

    /*
    Purpose:
    reads the parameter tags from existing applicant tags 
    parameter:
        - none (method wise)
    return 
        - weighting view 
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
            if (count($stuExtra) > 1)
                array_push($stuTag, $stuExtra[1]);
        }
        $MenCombineExtra = explode("`",$rawMenApp['extra']);
        for($i = 0; $i < count($MenCombineExtra); $i++){
            $menExtra = explode('|', $MenCombineExtra[$i]);
            if (count($menExtra) > 1)
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
