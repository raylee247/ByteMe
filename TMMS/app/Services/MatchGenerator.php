<?php namespace App\Services;

class MatchGenerator{

	/*
	|--------------------------------------------------------------------------
	| generate Trio match
	|
	*/
	// participants 
	protected $mentors = array();
	protected $seniors = array();
	protected $juniors = array();
	protected $report = array();

	protected $mentors_id = array();
	protected $seniors_id = array();
	protected $juniors_id = array();
	// param for generator
	protected $mustList;
	protected $priority;
	protected $wid;

	//table for values
	protected $MentorSatTable = array();
	protected $memory = array();
	protected $backTrack = array();

	/*
    Purpose:
    	class constructor, initialize basic information needed for any matching
    parameter:
        - mustList 
        - priorityList
    return 
        - n/a
    */
	public function __construct($mustList,$priority)
	{
	
		$this->getParticipant();
		$this->mustList = $mustList;
		$this->priority = $priority;
		
	}

	/*
    Purpose:
    	get mentors that is registered in current year
    parameter:
        - none
    return 
        - array of mentors in structure like so :

        array()
        |
        |['pid'] => array()
        |			|
        |			|['pid'] 
        |			|['First name'] 
        |			|['Family name'] 
        |			|['email'] 
    	|
    	...

    */
	public function getAvalMentors(){
		$result = array();
		foreach ($this->mentors as $pid => $info) {
			$temp = array();
			$temp['pid'] = $info['pid'];
			$temp['First name'] = $info['First name'];
			$temp['Family name'] = $info['Family name'];
			$temp['email'] = $info['email'];
			$result[$temp['pid']] = $temp;
		}
		return $result;
	}

	/*
    Purpose:
    	get Seniors that is registered in current year
    parameter:
        - none
    return 
        - array of mentors in structure like so :

        array()
        |
        |['pid'] => array()
        |			|
        |			|['pid'] 
        |			|['First name'] 
        |			|['Family name'] 
        |			|['email'] 
    	|
    	...

    */
	public function getAvalSeniors(){
		$result = array();
		foreach ($this->seniors as $pid => $info) {
			$temp = array();
			$temp['pid'] = $info['pid'];
			$temp['First name'] = $info['First name'];
			$temp['Family name'] = $info['Family name'];
			$temp['email'] = $info['email'];
			$result[$temp['pid']] = $temp;
		}
		return $result;
	}

	/*
    Purpose:
    	get Juniors that is registered in current year
    parameter:
        - none
    return 
        - array of mentors in structure like so :

        array()
        |
        |['pid'] => array()
        |			|
        |			|['pid'] 
        |			|['First name'] 
        |			|['Family name'] 
        |			|['email'] 
    	|
    	...

    */
	public function getAvalJuniors(){
		$result = array();
		foreach ($this->juniors as $pid => $info) {
			$temp = array();
			$temp['pid'] = $info['pid'];
			$temp['First name'] = $info['First name'];
			$temp['Family name'] = $info['Family name'];
			$temp['email'] = $info['email'];
			$result[$temp['pid']] = $temp;
		}
		return $result;
	}



	/*
    Purpose:
    	retrieve all the participants in current year that is in the db 
    parameter:
        - none
    return 
        - n/a
	effect
		retrieve participant (mentor/senior/junior) information from data base and store it in the following format

        array()
        |
        |['pid'] => array()
        |			|
        |			|['pid'] => 1234
        |			|['First name'] => "Billy"
        |			|['Family name']  => "Bob"
        |			|['email'] => example@example.com
     	|			|[other information] => "information value"
    	|
    	...

    */
	public function getParticipant(){


		$response_mentor= \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
												   ->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                                   ->where ('participant.year', '=', date("Y"))
                                                   ->where ('participant.waitlist', '=', 0)
                                                   ->get();
        
        foreach ($response_mentor as $key => $value) {
        	if (!$json = json_decode($value['extra'],TRUE)){
        		echo "<p> PID " . $value['pid'] . " fucked up json </p>";
        	}
    		
    		foreach ($json as $jkey => $jvalue) {
    			$value[$jkey] = $jvalue;
    		}	
    		unset($value['extra']);
        	$this->mentors[$value['pid']] = $value;
        }
         

		$response_seniors = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  	 ->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                                     ->where ('participant.year', '=', date("Y"))
                                                     ->where ('participant.waitlist', '=', 0)
                                                     ->get();

		foreach ($response_seniors as $key => $value) {
			if (!$json = json_decode($value['extra'],TRUE)){
        		echo "<p> PID " . $value['pid'] . " fucked up json </p>";
        	}
    		foreach ($json as $jkey => $jvalue) {
    			$value[$jkey] = $jvalue;
    		}	
    		unset($value['extra']);
        	$this->seniors[$value['pid']] = $value;
        }

		$response_juniors = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  	 ->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                                     ->where ('participant.year', '=', date("Y"))
                                                     ->where ('participant.waitlist', '=', 0)
                                                     ->get();
		
		foreach ($response_juniors as $key => $value) {
			if (!$json = json_decode($value['extra'],TRUE)){
        		echo "<p> PID " . $value['pid'] . " fucked up json </p>";
        	}
    		foreach ($json as $jkey => $jvalue) {
    			$value[$jkey] = $jvalue;
    		}	
    		unset($value['extra']);
        	$this->juniors[$value['pid']] = $value;
        }

        $response_report = \DB::table('report')->get();
        if(count($response_report)){
        	foreach ($response_report as $key => $value) {
        		$this->report[] = implode(",", array($value['mentor'], $value['senior'],$value['junior']));
        	}
        }

	}



	/*
    Purpose:
    	start point of the matching algorithm 
    parameter:
        - none
    return 
        - a set of matching with matching as key , and satisfaction rate as value
        result array()
        |
        |- [mid,sid,jid] => 75%
    	...

    */
	public function generate_all(){
		ini_set('memory_limit', '1000M');
		set_time_limit(3600);
		$this->mentors_id = array_keys($this->mentors);
		$this->seniors_id = array_keys($this->seniors);
		$this->juniors_id = array_keys($this->juniors);
		$this->generateTable($this->mentors_id,$this->seniors_id, $this->juniors_id);
		$result = $this->doStableMatch();
		return $result;
	}

	/*
    Purpose:
    	start point of the matching algorithm, with manual matching 
    parameter:
        - senior to exclude 
        - senior to exclude
        - junior to exclude 
    return 
        - a set of matching with matching as key , and satisfaction rate as value
        result array()
        |
        |- [mid,sid,jid] => 75%
    	...

    */
	public function generate_without($without_m,$without_s,$without_j){
		set_time_limit(3600);
		ini_set('memory_limit', '1000M');

		$this->mentors_id = array_keys($this->mentors);
		$this->seniors_id = array_keys($this->seniors);
		$this->juniors_id = array_keys($this->juniors);
		foreach ($without_m as $key => $value) {
			$this->mentors_id = $this->array_without($this->mentors_id,$value);
		}
		foreach ($without_s as $key => $value) {
			$this->seniors_id = $this->array_without($this->seniors_id,$value);
		}
		foreach ($without_j as $key => $value) {
			$this->juniors_id = $this->array_without($this->juniors_id,$value);
		}
		
		$this->generateTable($this->mentors_id,$this->seniors_id, $this->juniors_id);
		$result = $this->doStableMatch();
		return $result;
	}
    
    /*
    Purpose:
    	core logic of matching
    parameter:
		- none
    return 
        - a set of matching with matching as key , and satisfaction rate as value
        result array()
        |
        |- [mid,sid,jid] => 75%
    	...

    */
    public function doStableMatch(){
    	$mentors_queue = $this->mentors_id;
    	$seniors = $this->seniors_id;
    	$juniors = $this->juniors_id;
    	$result = array();
    	
    	// while there is still mentor to be match 
    	while ((count($mentors_queue) > 0) && (count($seniors) > 0) && (count($juniors) > 0)) {
    		// cause index '0' will not exist the first time after i delete it, so i delete the first in values
    		
    		// echo "<p> vvvvvvvvvvvvvvvvvvv=====MENTORS=====vvvvvvvvvvvvv</p>";
    		// var_dump($mentors_queue); 
    		// echo "<p> vvvvvvvvvvvvvvvvvvv=====SENIORS=====vvvvvvvvvvvvv</p>";
    		// var_dump($seniors); 
    		// echo "<p> vvvvvvvvvvvvvvvvvvv=====JUNIORS=====vvvvvvvvvvvvv</p>";
    		// var_dump($juniors); 
    		// echo "<p> =================================================</p>";



    		$target = array_values($mentors_queue)[0];
    		$maxTrio = $this->maxAvailiable($seniors,$juniors,$this->MentorSatTable[$target]);
    		if($maxTrio != ""){
    			// echo "<p>" . "" . "</p>";
    			// var_dump($seniors);
    			// var_dump($juniors);
    			 
    			// echo "<p> MAXTrio = " . $maxTrio . "</p>";
				$result[$maxTrio] = $this->MentorSatTable[$target][$maxTrio];
    			$key = explode(",", $maxTrio);
    			$seniors = $this->array_without($seniors, $key[1]);
    			$juniors = $this->array_without($juniors, $key[2]);
    			$mentors_queue = $this->array_without($mentors_queue, $target);
    		}else{
    			$swap = 0; 
    			foreach ($result as $match => $result_satisfaction) {
    				//find a confilcting matching with smaller sattisfaction 
    				$match_array = explode(",", $match);
    				foreach ($this->MentorSatTable[$target] as $trio => $satisfaction) {
    					$trio_array = explode(",", $trio);
    					$intersect = array_intersect(array($match_array[1],$match_array[2]), array($trio_array[1],$trio_array[2]));
    					if ($satisfaction > $result_satisfaction){
    						switch (count($intersect)) {
    							case 0:
    								// no intersect, do nothing 
    								break;
    							case 1:
    								// 1 intersection, try crazy stuff
    								$diff = array_diff(array($match_array[1],$match_array[2]), array($trio_array[1],$trio_array[2]));
    								foreach ($result as $swapTarget=> $swapTarget_satisfaction) {
    									if (($swapTarget != $match) &&
    										(strpos($swapTarget, array_values($diff)[0]) !== FALSE) && 
    										($satisfaction > $swapTarget_satisfaction)){
    										// free both other matches
    										// echo "<p> FREEING  " . $match . " and FREEING " . $swapTarget."</p>";
				    						$swapTarget_array = explode(",", $swapTarget);
				    						$mentors_queue[] = $swapTarget_array[0];
				    						$seniors[] = $swapTarget_array[1];
				    						$juniors[] = $swapTarget_array[2];
				    						unset($result[$swapTarget]);


				    						$mentors_queue[] = $match_array[0];
				    						$seniors[] = $match_array[1];
				    						$juniors[] = $match_array[2];
				    						unset($result[$match]);



				    						// add the better match into result
				    						$result[$trio] = $satisfaction;

				    						$mentors_queue = $this->array_without($mentors_queue, $trio_array[0]);
				    						$seniors = $this->array_without($seniors, $trio_array[1]);
				    						$juniors = $this->array_without($juniors, $trio_array[2]);
				    						
				    						$swap = 1;		
				    						break;
    									}
    								}
    								break;
    							case 2:
    								// echo "<p> freeing  " . $match . " and INSERTING " . $trio."</p>";
		    						$mentors_queue[] = $match_array[0];
		    						$seniors[] = $match_array[1];
		    						$juniors[] = $match_array[2];
		    						unset($result[$match]);

		    						// add the better match into result
		    						$result[$trio] = $satisfaction;

		    						$mentors_queue = $this->array_without($mentors_queue, $trio_array[0]);
		    						$seniors = $this->array_without($seniors, $trio_array[1]);
		    						$juniors = $this->array_without($juniors, $trio_array[2]);
		    						
		    						$swap = 1;
    								break;
    							
    						}
    						if ($swap){
		    					break;
		    				}
    					}
    				}
    				if ($swap){
    					break;
    				}
    				// if such matching does not exist,
    				// drop the mentor 
    			}
    			if(!($swap)){
    				$mentors_queue = $this->array_without($mentors_queue, $target);
    			}
    		}

    	}
    	return $result;
   
    }

    /*
    Purpose:
    	gets the unmatched participants given a result
    parameter:
		- result 
    return 
        - a set of matching with matching as key , and satisfaction rate as value
        array()
        |
        |['pid'] => array()
        |			|
        |			|['pid'] 
        |			|['First name'] 
        |			|['Family name'] 
        |			|['email'] 
    	|
    	...

    */
    public function get_unmatches($result){
    	$LoMid = array();
    	$LoSid = array();
    	$LoJid = array();
    	// var_dump($result); 
    	foreach ($result as $key => $value) {
    		$key_array = explode(",", $key);
    		$LoMid[] = $key_array[0];
    		$LoSid[] = $key_array[1];
    		$LoJid[] = $key_array[2];
    	}

    	$m_diff = array_diff($this->mentors_id,$LoMid);
    	$s_diff = array_diff($this->seniors_id,$LoSid);
    	$j_diff = array_diff($this->juniors_id,$LoJid);
    	// var_dump($m_diff);
    	// var_dump($s_diff);
    	// var_dump($j_diff);

    	$result_unmatches = array();
    	foreach ($m_diff as $key => $value) {
    		$temp = array();
    		$person = $this->getPersonWithID($value);
    		$temp['type'] = "Mentor";
    		$temp['FirstName'] = $person['First name'];
    		$temp['LastName'] = $person['Family name'];
    		$temp['email'] = $person['email'];
    		$temp['pid'] = $person['pid'];
    		$temp['waitlist'] = $person['waitlist'];
    		$result_unmatches[] = $temp;
    	}
    	foreach ($s_diff as $key => $value) {
    		$temp = array();
    		$person = $this->getPersonWithID($value);
    		$temp['type'] = "Senior";
    		$temp['FirstName'] = $person['First name'];
    		$temp['LastName'] = $person['Family name'];
    		$temp['email'] = $person['email'];
    		$temp['pid'] = $person['pid'];
    		$temp['waitlist'] = $person['waitlist'];
    		$result_unmatches[] = $temp;
    	}
    	foreach ($j_diff as $key => $value) {
    		$temp = array();
    		$person = $this->getPersonWithID($value);
    		$temp['type'] = "Junior";
    		$temp['FirstName'] = $person['First name'];
    		$temp['LastName'] = $person['Family name'];
    		$temp['email'] = $person['email'];
    		$temp['pid'] = $person['pid'];
    		$temp['waitlist'] = $person['waitlist'];
    		$result_unmatches[] = $temp;
    	}
    	// var_dump($result_unmatches);
    	return $result_unmatches;

    }

    /*
    Purpose:
    	turns keys of the given result from id to name
    parameter:
		- result 
    return 
        - a set of matching with matching as key , and satisfaction rate as value
        array()
        |
        |[bill Bob,ray kirby, john william] => 75%
    	...

    */
    public function toName($result){
    	$result_name = array();
		foreach ($result as $key => $value) {
			$match_array = explode(",", $key);
			$mid = $match_array[0];
			$sid = $match_array[1];
			$jid = $match_array[2];
			
			$m = $this->ID_to_Name($mid);
			$s = $this->ID_to_Name($sid);
			$j = $this->ID_to_Name($jid);

			$match = $m . "," . $s . "," . $j;
			$result_name[$match] = $value;
		}
    	return $result_name;
    }

    /*
    Purpose:
    	translate id to name 
    parameter:
		- id 
    return 
        - name of the id

    */
    public function ID_to_Name($id){
    	$p = $this->getPersonWithID($id);
    	return $p['First name'] . " " . $p['Family name'];
    }

    
	/*
    Purpose:
        delete an element fomr the array provided 
    parameter:
        - array
        - victim 
    return 
        - array without the victim

    */
	public function array_without($array,$victim){
		$result = $array; 
		if(($key = array_search($victim, $array)) !== false) {
	    	unset($result[$key]);
		}
		return $result;
	}

    /*
    Purpose:
        return the the key that holds the maximum value 
    parameter:
        - list of available senior student
        - list of available junior student
        - target array value to find maximum
    return 
        - the key that holds the maximum value in $targetArray

    */
	public function maxAvailiable($seniors,$juniors,$targetArray){
		
		$temp = $targetArray;
		$result="";
		$maximum = -1;
		foreach ($temp as $key => $value) {
			$senior = explode(",", $key)[1];
			$junior = explode(",", $key)[2];
			if (($value > $maximum) && (in_array($senior, $seniors)) && (in_array($junior, $juniors))){
				$maximum = $value;
				$result = $key;	
			}

		}
		return $result;
	}

	/**
	 * compute the satisfaction of ALL possible combination 
	 * the table will be in format like so 
	 * array(
	 * 		"mentorA"	:	array(
 	 * 							 "mentorA,seniorA,studentA" : satisfaction rate
 	 * 							 "mentorA,seniorA,studentB" : satisfaction rate...)
	 * 		"mentorB"	:	array(
 	 * 							 "mentorB,seniorA,studentA" : satisfaction rate
 	 * 							 "mentorB,seniorA,studentB" : satisfaction rate...)
	 * @return Void
	 */
    /*
    Purpose:
        compute the satisfaction of ALL possible combination 
    parameter:
        - mentors 
        - seniors
        - juniors 
    return 
        - void
    effect 
        the table will be in format like so 
        array(
             "mentorA"   :   array(
                                  "mentorA,seniorA,studentA" : satisfaction rate
                                  "mentorA,seniorA,studentB" : satisfaction rate...)
             "mentorB"   :   array(
                                  "mentorB,seniorA,studentA" : satisfaction rate
                                  "mentorB,seniorA,studentB" : satisfaction rate...)

    */
	public function generateTable($mentors,$seniors,$juniors){
		
		foreach ($mentors as $mentor) {
			$temp = array();
			foreach ($seniors as $senior) {
				foreach ($juniors as $junior) {
					$key = $mentor . "," . $senior . "," . $junior;
					$satisfaction = $this->trioMatch($mentor,$senior,$junior);
					if( $satisfaction > 50 && $this->checkReport($key)){
						$temp[$key] = $satisfaction;
					}
				}
			}
			$this->MentorSatTable[$mentor] = $temp;
		}
	}

	/*
    Purpose:
    	check if this matching exist in previous year report already 
    parameter:
		- match key [mid,sid,jid] 
    return 
        - true if it does exist else false
    */
	public function checkReport($match){
		return !array_key_exists($match, $this->report);
	}

	/*
    Purpose:
        match the three person provided 
    parameter:
        - mentor
        - senior
        - junior
    return 
        - satisfaction rate
    */
	public function trioMatch($personA, $personB, $personC){
		$A = $this->getPersonWithID($personA);
		$B = $this->getPersonWithID($personB);
		$C = $this->getPersonWithID($personC);

		$pair1 = $this->match($A,$B);
		$pair2 = $this->match($B,$C);
		$pair3 = $this->match($A,$C);

		if($pair1 == 0 || $pair2 == 0 || $pair3 == 0){
			return 0;
		}

		$total = $pair1 + $pair2 + $pair3;

		return $total/3 ;
	}

	/*
    Purpose:
        get the person's information with id
    parameter:
        - id
    return 
        - person's information in an array
    */
	public function getPersonWithID($id){
        if(array_key_exists($id, $this->mentors)){
        	return $this->mentors[$id];
        }elseif(array_key_exists($id, $this->seniors)){
        	return $this->seniors[$id];
        }elseif(array_key_exists($id, $this->juniors)){
        	return $this->juniors[$id];
        }else{
        	return array();
        }
	}

	/*
    Purpose:
        match 2 person provided 
    parameter:
        - person A
        - person B 
    return 
        - satisfaction rate of two people
    */
	public function match($personA,$personB){
		// do must
		if (count($this->mustList)){
			foreach ($this->mustList as $m){
				switch ($m){
					case "kickoff":
						if (!$this->dataAvalibility($personA["kickoff"],$personB["kickoff"])){
							return 0;
						}
						break;
					case "genderpref":
						if(!$this->genderprefCheck($personA['genderpref'],$personB['genderpref'])){
							return 0;
						}
						break;
					default :
						if(array_key_exists($m,$personA) && array_key_exists($m,$personB)){
							if (is_array($personA[$m])){
								$length = $personA[$m];
								if ((count(array_intersect($personA[$m], $personB[$m]))/$length) != 1){
									return 0;
								}
							}else{
								if($personA[$m] != $personB[$m]){
									return 0;
								}
							}
						}
						break;
				}
			}
		}


		$length = count($this->priority);
		$weighting = count($this->priority);
		$totalWeight = (($length+1)*$length)/2; 
		$priorityResult = 0;

		for($counter = 0 ; $counter < $length; $counter++){
			$tag = $this->priority[$counter];
			switch ($tag) {
				case 'kickoff':
					if ($this->dataAvalibility($personA["kickoff"],$personB["kickoff"])){
						$tag_result = 1;
					}else{
						$tag_result = 0;
					}
					break;
				case 'genderpref':
					if ($this->genderprefCheck($personA,$personB)){
						$tag_result = 1;
					}else{
						$tag_result = 0;
					}
					break;
				default:
					if(array_key_exists($tag, $personA)){
						$pA_value = explode(",", $personA[$tag]);
					}else{
						$pA_value = array();
					}
					if(array_key_exists($tag, $personB)){
						$pB_value = explode(",", $personB[$tag]);
					}else{
						$pB_value = array();
					}
					
					$tag_result = $this->array_similarity($pA_value,$pB_value);
					break;
			}

			$priorityResult += $tag_result*$weighting;
			$weighting--;
		}

		$priorityResult = $priorityResult/$totalWeight;
		$finalResult = 50 + 50*$priorityResult;

		return $finalResult;
	}

	/*
    Purpose:
        compute the similarity of two array  
    parameter:
        - array 1
        - array 2 
    return 
        - similarity of two array
    */
	public function array_similarity($a1, $a2){

		$lengtha1 = count($a1);
		$lengtha2 = count($a2);
		if(($lengtha1 < 1) || ($lengtha2 <1)){
			return 0;
		}
		$a1_local = array();
		$a2_local = array();

		// remove all white spcae in between each word
		foreach ($a1 as $value) {
			$temp = preg_replace('/\s+/', '', $value);
			$temp = strtolower($temp);
			array_push($a1_local, $temp);
		}
		foreach ($a2 as $value) {
			$temp = preg_replace('/\s+/', '', $value);
			$temp = strtolower($temp);
			array_push($a2_local, $temp);
		}
		$commonStringCount = count(array_intersect($a1_local, $a2_local));

		$similiraitya1 = $commonStringCount/$lengtha1;
		$similiraitya2 = $commonStringCount/$lengtha2;

		return ($similiraitya1 + $similiraitya2 )/2;

	}

	/*
    Purpose:
        check if two given array of date have at least one day in common
    parameter:
        - array of date 
        - array of date
    return 
        - true if such common date exist, else false 
    */
	public function dataAvalibility($a1,$a2){
		if(($a1 == "")||($a2 == "")){
			return false;
		}
		$array1 = explode(",", $a1);
		$array2 = explode(",", $a2);
		$result = array_intersect($array1, $array2);
		if (is_array($result) && (count($result)>0)){
			return true;
		}else{
			return false;
		}
	}

	/*
    Purpose:
    	check if the given 2 participant match each other's gender preference
    parameter:
		- participant A
		- participant B 
    return 
        - true if the condition is met, else false 

    */
	public function genderprefCheck($personA,$personB){
		$AGender = $personA['gender'];
		$APref = $personA['genderpref'];

		$BGender = $personB['gender'];
		$BPref = $personB['genderpref'];

		if((strpos($AGender,"male")!== FALSE) && ((strpos($BPref, "male")!== FALSE)||(strpos($BPref, "No")!== FALSE))){
			return TRUE;
		}
		if((strpos($AGender,"female")!== FALSE) && ((strpos($BPref, "male")!== FALSE)||(strpos($BPref, "No")!== FALSE))){
			return TRUE;
		}
		if((strpos($BGender,"male")!== FALSE) && ((strpos($APref, "male")!== FALSE)||(strpos($APref, "No")!== FALSE))){
			return TRUE;
		}
		if((strpos($BGender,"female")!== FALSE) && ((strpos($APref, "male")!== FALSE)||(strpos($APref, "No")!== FALSE))){
			return TRUE;
		}

		return FALSE;
	}

}