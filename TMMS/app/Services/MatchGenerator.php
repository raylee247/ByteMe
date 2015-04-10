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

    
    /**
	 * DYNAMIC PROGRAMMING WOOOOOOHOOOOOOO
	 * since mentor is the primary constraint on the program, 
	 * i write this function base on mentors for now
	 *
	 * @param list of available mentors
	 * @param list of available senior student
	 * @param list of available junior student
	 *
	 * @return result of the matching in format of array {[mid, sid, jid]}
	 */
	public function doTheMatch($mentors,$seniors,$juniors){
		//print("******************* in dothematch function *******************\n");
		// var_dump($mentors);
		// echo "<p> computing</p>";
		$key = implode(",", $mentors);
		$key .= ",";
		$key .= implode(",", $seniors);
		$key .= ",";
		$key .= implode(",", $juniors);
		//print("\n");
		//print("the value of key is = ");
		//print($key);
		//print("\n\n");
		if (array_key_exists($key, $this->memory)){
			//print("\n\nresult exist\n\n");
			//print("******************* end of dothematch function if *******************\n\n");
			return  $this->memory[$key];
		}else{
			//print("\n\ncompute\n\n");
			$this->memory[$key] = $this->doTheMatch_compute($mentors,$seniors,$juniors);
			//print("******************* end of dothematch function else *******************\n\n");
			return $this->memory[$key];
		}
	}
	public function doTheMatch_compute($mentors,$seniors,$juniors){
		// match a mentor each time
		//print("******************* in doTheMatch_compute function *******************\n");
		// print ("\ndoTheMatch with parameter: ");
		// print ("\n senior:");
		// var_dump($seniors);
		// print ("\n junior:");
		// var_dump($juniors);

		$target = array_values($mentors)[0];
		//print ("\ntarget:");
		//print($target);
		//print("\n\n");
		// base case
		//print ("number of mentors:");
		//print(count($mentors));
		//print("\n\n");
		if (count($mentors) == 1){
			// return the key with the maxx vlaue 
			//should sotre the key somewhere for backtracking
			$key = $this->maxAvailiable($seniors,$juniors,$this->MentorSatTable[$target]);
			// print("\n\nwilliam your code breaks here\n\n");
			// var_dump($this->MentorSatTable);
			//print("\n");
			//print("this is the value of key: ");
			//print($key);
			//print("\n");
			$value = $this->MentorSatTable[$target][$key]; 
			//print("\n\nit actually reach here\n\n");
			$backTrackkey = implode(",", $mentors);
			$backTrackkey .= ",";
			$backTrackkey .= implode(",", $seniors);
			$backTrackkey .= ",";
			$backTrackkey .= implode(",", $juniors);
			$this->backTrack[$backTrackkey] = $key;
			//print("******************* done with doTheMatch_compute function value *******************\n\n");
			return $value;
		}else{
			// find max of all combination for this mentor at this level 
			// max( not using this mentor, using this mentor)
			// in the using this mentor case, we want the max(all possible combination)
			$result = array();
			$resultKey = array();
			// using this mentor 
			// for all the match possible for this mentor, for example, <mentorA, seniorA, junior A>
			// call doTheMatch($mentors - mentorA ,$seniors - SeniorA ,$juniors - JuniorA )
			// return the maximum value of the cases 
			$mod_mentors = $this->array_without($mentors,$target);
			foreach ($seniors as $senior) {
				foreach ($juniors as $junior) {
					// call dotheMatch 
					$mod_seniors = $this->array_without($seniors,$senior);
					$mod_juniors = $this->array_without($juniors,$junior);
					$key = $target . "," . $senior . "," . $junior;
					//print("\ndo matching with key:");
					//print($key);
					//print("\n\n");
					// var_dump($this->MentorSatTable[$target][$key]);
					$temp = $this->MentorSatTable[$target][$key] + $this->doTheMatch($mod_mentors,$mod_seniors,$mod_juniors);
					$result[$key] = $temp; 
					
				}
			}
			// not using this mentor
			// call doTheMatch without this mentor, senior and junior remains 
			$without = $this->doTheMatch($mod_mentors,$seniors,$juniors);
			if(count($result) < 1){
				$with = 0;
			}else {
				$with = max($result);
			}
			

			if($with > $without){
				$choice = array_keys($result,$with);
				$backTrackkey = implode(",", $mentors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $seniors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $juniors);
				$this->backTrack[$backTrackkey] = $choice[0];
				//print("******************* done with doTheMatch_compute function with *******************\n\n");
				return $with; 
			}else{
				$choice = "no including mentor " . $target;
				$backTrackkey = implode(",", $mentors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $seniors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $juniors);
				$this->backTrack[$backTrackkey] = $choice;
				//print("******************* done with doTheMatch_compute function without *******************\n\n");
				return $without;
			}
		}
	}

	/*
    Purpose:
    	back tracking of dynamic programming approach, left here for reference but not used 
    parameter:
        - available mentors 
        - available seniors
        - available juniors 
    return 
        - n.a (never got this part of returning value, currently echos)

    */
    public function doBackTrack($mentors,$seniors,$juniors){
    	// print("******************* in dobacktrack function *******************\n");
    	$key = implode(",", $mentors);
		$key .= ",";
		$key .= implode(",", $seniors);
		$key .= ",";
		$key .= implode(",", $juniors);
		// print ($key);
		if (array_key_exists($key, $this->backTrack)){
			$match = $this->backTrack[$key];
			// print ("\n");
			// print($match);
			
			$match_array = explode(",", $match);
			echo "<p> for this key: " . $key. "</p>";
			echo "<p>" . $match . " : " . $this->trioMatch($match_array[0],$match_array[1],$match_array[2]) ."</p>";
			if (count($match_array) > 1){
				$target_mentor = $match_array[0];
				$target_senior = $match_array[1];
				$target_junior = $match_array[2];
				$mod_mentors = $this->array_without($mentors,$target_mentor);
				$mod_seniors = $this->array_without($seniors,$target_senior);
				$mod_juniors = $this->array_without($juniors,$target_junior);
				$this->doBackTrack($mod_mentors, $mod_seniors,$mod_juniors);
			}else{
				// $victim = array_values($mentors)[0]
				// $mod_mentors = array_without();
				echo "end";
			}
		}
		// print("\n******************* end of dobacktrack function *******************\n\n");
		// var_dump($this->backTrack);
		// foreach ($this->backTrack as $key => $value) {
		// 	echo "<p> for this key: " . $key. "</p>";
		// 	echo "<p>                  we pick " . $value . "</p>";
		// }
    }

	/**
	 * return an copy of the given array with out the given key
	 *
	 * @param array to remove the victim
	 * @param the victim
	 *
	 * @return the key that holds the maximum value in $targetArray
	 */
	public function array_without($array,$victim){
		$result = $array; 
		if(($key = array_search($victim, $array)) !== false) {
	    	unset($result[$key]);
		}
		return $result;
	}

	/**
	 * return the the key that holds the maximum value 
	 *
	 * @param list of available senior student
	 * @param list of available junior student
	 * @param target array value to find maximum
	 *
	 * @return the key that holds the maximum value in $targetArray
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

	/**
	 * compute the satisfaction rate of two provided person 
	 *
	 * @param First person to match
	 * @param Second person to match
	 * @param third person to match
	 * 
	 * @return satisfaction rate 
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

	/**
	 * get the person's information from db  
	 *
	 * @param participant's id
	 * 
	 * @return array of person's information 
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

	/**
	 * compute the satisfaction rate of two provided person 
	 *
	 * @param First person to match
	 * @param Second person to match
	 * 
	 * @return satisfaction rate 
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

	/**
	 * compute the similiraity of two given array
	 *
	 * @param array 1
	 * @param array 2
	 * 
	 * @return similarity rate
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

	/**
	 * compute the if two given array has date in common 
	 *
	 * @param array 1
	 * @param array 2
	 * 
	 * @return true if they have common date, else false
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