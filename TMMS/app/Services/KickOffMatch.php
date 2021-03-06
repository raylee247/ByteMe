<?php namespace App\Services;

class KickOffMatch{

	/*
	|--------------------------------------------------------------------------
	| generate Kickoff match
	|--------------------------------------------------------------------------
	| this shit does the kcikoff
	| 
	|
	*/
	// participants 
	protected $current_matches = array();
	protected $ppl_p_night = array();
	protected $kick_off_nights = array();
	protected $max_participant;
	protected $num_of_nights;
	protected $mentorsInGroup;
	protected $allgroups = array();
	protected $fullMentorTable = array();
	protected $participantTable = array();
	protected $num_of_col;

	/**
	 * Function: Constructor
	 * Create a new service instance that for kickoff matching
	 *
	 * Parameter: max - the maximum number of participant per night
	 * 		  	  menter_per_group - the ideal number of mentors each kickoff night's group
	 *
	 * Return: nothing
	 */
	public function __construct($max, $mentor_per_group)
	{
		// print("********************* in constructor **********************\n");
		$this->current_matches  = \DB::table('report')->where('report.year', '=', date('Y'))->get();

		$this->num_of_col = count($this->current_matches[0]);

		$this->max_participant = $max;

		$this->mentorsInGroup = $mentor_per_group;
		$this->fullMentorTable = \DB::table('mentor')->get();
		$this->participantTable = \DB::table('participant')->where('participant.year', '=', date('Y'))->get();

		$kickoffnights = array();
		$participantkickoff;

		// print("\n\nhere\n\n");
		//append all kcikoff night of all participant this year

		foreach($this->participantTable as $participant){
			if(empty($participantkickoff)){
				$participantkickoff = $participant["kickoff"];
			}else{
				$participantkickoff = $participantkickoff.",".$participant["kickoff"];
			}

		}

		//put them into a unique array which reemoves the duplicates
		$kickoffnights = array_unique(explode(",", $participantkickoff));

		// print("printing kickoffnight");
		// var_dump($kickoffnights);

		//remove the qeird kickoff night cases that we put as dummy cases
		foreach ($kickoffnights as $key => $value){
			if(strcmp($value, "1111") == 0){
				unset($kickoffnights[$key]);
				// print("\n\nhere1\n\n");
			}else{
				if(strcmp($value, "Kickoff Date") == 0){
					unset($kickoffnights[$key]);
					// print("\n\nhere2\n\n");
				}else{
					if(strcmp($value, "09-09-9282") == 0){
						unset($kickoffnights[$key]);
						// print("\n\nhere3\n\n");
					}else{
						if(strcmp($value, "") == 0){
						unset($kickoffnights[$key]);
						// print("\n\nhere4\n\n");
					}else{
						if(strcmp($value, "hahaha") == 0){
							unset($kickoffnights[$key]);

						}
					}
					}
				}
			}
		}

		// print("\n");
		// print("printing kickoffnight");
		// var_dump($kickoffnights);
		// print("\n");

		//push found kickoff night to global kick off night
		foreach ($kickoffnights as $value) {
			array_push($this->kick_off_nights, $value);
		}

		// print("\n\nhere\n\n");

		// print("\n");
		// print("printing kickoffnight");
		// var_dump($this->kick_off_nights);
		// print("\n");

		$this->num_of_nights = count($this->kick_off_nights);

		// var_dump($kickoffnights);

		//add the quota for people per night for each date to global
		for($i = 0; $i < $this->num_of_nights; $i++){
			array_push($this->ppl_p_night, $this->max_participant);
			$newkey = $this->kick_off_nights[$i];
			$this->ppl_p_night[$newkey] = $this->ppl_p_night[$i];
			unset($this->ppl_p_night[$i]);
		}

		// var_dump($this->kick_off_nights);

		// print("********************* end of constructor **********************\n");

		// var_dump($this->current_matches);
		// print("\n");
		// var_dump($this->ppl_p_night);
		// print("\n");
		// var_dump($this->kick_off_nights);
		// print("\nmax = ");
		// print($this->max_participant);
		// print("\n");
		// print("\nnights = ");
		// print($this->num_of_nights);
		// print("\n");
		// var_dump($this->fullMentorTable);
	}


	/**
	 * Function: generate kickoff
	 * start point of the generation of result
	 *
	 * Parameters: none
	 * 
	 * Return: result of the matching in an representative array format; night as array key each element of 
	 *		   of the night is an array of groups, each group contains an array of members
	 */
	
	public function generate(){
		// $this->test();
		// print("********************* in generate function **********************\n");
		ini_set('memory_limit', '1000M');
		// set_time_limit(3600);
		$this->setKickOffDay();
		$response = $this->setGroup();
		// var_dump($response);
		// print("******************* end of genrate function *******************\n\n");
		return $response;
	}

	/**
	 * Fuction: set kickoff day
	 * add a day for each trio matched pair; modifies and changes the current matches and add a attending 
	 * date to all trio
	 *
	 * Parameter: none
	 *
	 * Return: nothing
	 */
	public function setKickOffDay()
	{
		// print("********************* in setKickOffDay function **********************\n");
		$this->addAvailableDayToTrio();
		$this->pickday();
		//$this->getSpaceLeft();
		// print("\n******************* end of setKickOffDay function *******************\n\n");
	}

	/**
	 * Function: add available day to trio
	 * gets the available day of the trio, add to the array; modifies and changes the current matches and add
	 * a attending date to all trio
	 *
	 * Parameter: none
	 *
	 * Return: nothing 
	 */
	public function addAvailableDayToTrio()
	{
		// print("********************* in addAvailableDayToTrio function **********************\n");
		$temp_array = array();

		foreach($this->current_matches as $element){

			foreach($this->participantTable as $data){
				if($data['pid'] == $element['mentor']){
					$mentor_availableday = $data['kickoff'];
				}else{
					if($data['pid'] == $element['senior']){
						$senior_availableday = $data['kickoff'];
					}else{
						if($data['pid'] == $element['junior']){
							$junior_availableday = $data['kickoff'];
						}
					}
				}
			}

			//print($element['mentor']);
			//var_dump($mentor_availableday);

			if(!is_array($mentor_availableday)){
				$mentor_availableday = explode(",", $mentor_availableday);
			}
			
			if(!is_array($senior_availableday)){
				$senior_availableday = explode(",", $senior_availableday);
			}
			
			if(!is_array($junior_availableday)){
				$junior_availableday = explode(",", $junior_availableday);
			}

			$result = array_intersect($mentor_availableday, $senior_availableday);
			$result = array_intersect($result, $junior_availableday);

			$element_string = "";

			foreach($element as $data){
				if(empty($element_string))
					$element_string = $element_string.$data;
				else
					$element_string = $element_string.",".$data;
			}			

			foreach($result as $data){
				$element_string = $element_string.",".$data;
			}

			array_push($temp_array, explode(",",$element_string));
		}

		$this->current_matches = $temp_array;
		// print("********************* end of addAvailableDayToTrio function **********************\n\n");
	}

	/**
	 * Function: pick a day for trio
	 * picks a particular kickoff day for the trio; modifies and changes the current matches and add a attending 
	 * date to all trio
	 *
	 * Parameter: none
	 *
	 * Return: nothing
	 */
	public function pickday()
	{
		// print("********************* in pickday function **********************\n");
		// print("\n\n");
		// print("number of matches = ");
		// print(count($this->current_matches));
		// print("\n\n");
		for ($i = 0; $i<count($this->current_matches); $i++) {
			$element = $this->current_matches[$i];
			$dates = array_slice($element, $this->num_of_col);
			// var_dump($dates);
			if(count($dates)==1){
				$this->ppl_p_night[$dates[0]] = $this->ppl_p_night[$dates[0]]-3;
			}else{
					$day = $this->findBestDay($element);
					$element = array_slice($element, 0, ($this->num_of_col-1));
					array_push($element, $day);
					// var_dump($element);
					$this->current_matches[$i] = $element;
				}
			}
		// print("********************* end of pickday function **********************\n\n");
	}

	/**
	 * Function: find the best day int trio
	 * picks a particular kickoff day for the trio if they have more that one commoon available day; modifies
	 * and changes the current matches and add a attending date to all trio
	 * 
	 * Parameter: element - the full trio record from the report table in the database
	 * 
	 * Return: return the chosen night for the specific group
	 */
	public function findBestDay($element)
	{
		// print("********************* in findBestDay function **********************\n");
		//find the night with the least members
		$dates = array_slice($element, $this->num_of_col);
		$night = "";
		$max = -9999;
		foreach($dates as $date){
			if($this->ppl_p_night[$date] > $max){
				$max = $this->ppl_p_night[$date];
				$night = $date;
				// print("date = ");
				// print($date);
				// print("\n");
				// print("max = ");
				// print($max);
				// print("\n");
				// print("night = ");
				// print($night);
				// print("\n\n");
			}
		}		// array_push($element, $night);
		// var_dump($element);
		// var_dump($this->ppl_p_night);
		// print("\n\n");
		// print($max);
		// print("\n\n");

		if(empty($night)){
			foreach($this->ppl_p_night as $key => $value){
				// var_dump($this->ppl_p_night);
				// print("\n\n");
				// print("value = ");
				// print($value);
				// print("\n\n");
				if($value > $max){
					$max = $value;
					//print($key);
					$night = $key;
				}
				// print("date = ");
				// print($key);
				// print("\n");
				// print("max = ");
				// print($max);
				// print("\n");
				// print("night = ");
				// print($night);
				// print("\n\n");

			}
		}
		$this->ppl_p_night[$night] = $this->ppl_p_night[$night]-3;
		// print($night);
		// print(" quota = ");
		// print($this->ppl_p_night[$night]);
		// print("********************* end of findBestDay function **********************\n\n");
		return $night;
	}

	/**
	 * Function: set the groups for kickoff
	 * populates All groups with its night as its key
	 *
	 * Parameter: none
	 *
	 * Return: returns an array with the night as the key and contents of the resulting groups
	 */
	public function setGroup()
	{
		// print("********************* in setGroup function **********************\n");
		//set_time_limit(3600);
		$result = array();
		$count = 0;
		foreach($this->kick_off_nights as $night){
			//compute all the students and mentors attending this night's kickoff
			$kickoff_trios = array();
			// $kickoff_senior = array();
			// $kickoff_junior = array();
			foreach($this->current_matches as $matches){
				if(strcmp($matches[5], $night)==0){
					array_push($kickoff_trios, $matches);
					// array_push($kickoff_senior, $matches[2]);
					// array_push($kickoff_junior, $matches[3]);
				}
			}
			$num_of_groups = floor(count($kickoff_trios)/$this->mentorsInGroup);

			if($num_of_groups == 0){
				$num_of_groups = 1;
			}

			$resultofday = array();

			$counter = 0;

			foreach($kickoff_trios as $trio){
				//put all the mentors into groups
				$group;
				$mentor_id = $trio[1];

				if(count($resultofday) == $num_of_groups){
					$group = $resultofday[$counter%$num_of_groups];
				}else{
					$group = array();
				}

				if(empty($group)){
					array_push($group, $mentor_id);
					array_push($resultofday, $group);
				}else{
					$validity = 1;
					foreach($group as $group_member){
						$validity = $this->is_valid($mentor_id, $group_member);

						if($validity == -1){
							break;
						}

						// if(empty($validity)){
						// 	print("empty");
						// }else{
						// 	print($validity);
						// }
						// print("\n\n");
					}

					if($validity == 1){
						array_push($group, $mentor_id);
						$resultofday[$counter%$num_of_groups] = $group;
					}else{
						array_push($resultofday[$this->putIntoGroup($counter%$num_of_groups, $num_of_groups, $resultofday, $mentor_id)], $mentor_id);
					}
				}
				$counter++;
			}

			//put the students into groups
			for($i = 0; $i<count($resultofday); $i++){
				foreach($resultofday[$i] as $result_id){
					foreach ($kickoff_trios as $trio) {
						if($result_id == $trio[1]){
							array_push($resultofday[($num_of_groups-1)-(($i+1)%$num_of_groups)], $trio[2]);
							array_push($resultofday[($num_of_groups-1)-(($i+2)%$num_of_groups)], $trio[3]);
						}
					}
				}
			}
			
			// $counter = 1;
			// foreach($kickoff_senior as $senior_id){
			// 	//put all senior student into groups
			// 	array_push($resultofday[$counter%$num_of_groups], $senior_id);
			// 	$counter++;
			// }

			// $counter = 2;
			// foreach($kickoff_junior as $junior_id){
			// 	//put all senior student into groups
			// 	array_push($resultofday[$counter%$num_of_groups], $junior_id);
			// 	$counter++;
			// }

			array_push($result, $resultofday);
			$newkey = $night;
			$result[$newkey] = $result[$count];
			unset($result[$count]);
			$count++;
		}

		// print("********************* end of setGroup function **********************\n\n");

		return $result;
	}

	/**
	 * Function: chack mentor validity
	 * checks if 2 mentors can be put into the same group
	 *
	 * Parameter: none
	 *
	 * Return: 1 if the mentors can be put into the same group, else -1
	 */
	public function is_valid($mentor1, $mentor2){
		// print("*********************  in is_valid function **********************\n\n");
		//set_time_limit(3600);

		$m1_company = "";
		$m1_job = "";
		$m2_company = "";
		$m2_job = "";

		// $return = -1;

		foreach($this->fullMentorTable as $data){
			if($data["mid"] == $mentor1){
				$m1_job = $data["job"];
				$m1_company = $data["company"];
			}else{
				if($data["mid"] == $mentor2){
					$m2_job = $data["job"];
					$m2_company = $data["company"];
				}
			}
		}

		if(!empty($m1_company)){
			str_replace(" ", "", $m1_company);
			$m1_company = strtolower($m1_company);
		}else{
			return 1;
		}

		if(!empty($m1_job)){
			str_replace(" ", "", $m1_job);
			$m1_job = strtolower($m1_job);
		} 

		if(!empty($m2_company)){
			str_replace(" ", "", $m2_company);
			$m2_company = strtolower($m2_company);
		}else{
			return 1;
		}

		if(!empty($m2_job)){
			str_replace(" ", "", $m2_job);
			$m2_job = strtolower($m2_job);
		}

		// print($m1_company);
		// print("\n");
		// print($m2_company);
		// print("\n");
		// print($m1_job);
		// print("\n");
		// print($m2_job);
		// print("\n\n");

		similar_text($m1_job, $m2_job, $m1_m2_job);
		similar_text($m2_job, $m1_job, $m2_m1_job);
		similar_text($m1_company, $m2_company, $m1_m2_company);
		similar_text($m2_company, $m1_company, $m2_m1_company);


		if(($m1_m2_job > 80) || ($m2_m1_job > 80) || ($m1_m2_company > 80) || ($m2_m1_company > 80) || ($m1_company == $m2_company) || (strpos($m1_company, $m2_company) !== false) || (strpos($m2_company, $m1_company) !== false)){
			// print("********************* end of is_valid function **********************\n\n");
			// $return = -1;
			return -1;
		}else{
			// print("********************* end of is_valid function **********************\n\n");
			// $return = 1;
			return 1;
		}
	}
	/**
	 * Function: put the mentor with $mentor_id into a group
	 * puts the mentor into a group; this function should only be called when validity of a mentor returned by is_valid is -1
	 * and the mentor is needed to put into some other group
	 *
	 * Parameters: curr_num - the group number tried that is_valid returned as -1
	 * 		  	   group_total - the total number of groups
	 * 		 	   curr_group - an array of all the groups for the night the mentor with mentor_id will attend
	 * 		 	   mentor_id - the id of the mentor that needs a group for their kickoff night
	 *
	 * Return: return the group number that mentor_id should end up being in
	 */
	public function putIntoGroup($curr_num, $group_total, $curr_group, $mentor_id){
		// print("********************* in putIntoGroup function **********************\n\n");
		$order = array();
		foreach($curr_group as $group){
			array_push($order, count($group));
		}
		asort($order);

		for($i=0; $i<count($order); $i++){
			$validity = 1;
			foreach($order as $group_to_test => $count){
				foreach($curr_group[$group_to_test] as $group_member){
					$validity = $this->is_valid($mentor_id, $group_member);
					if($validity == -1){
						break;
					}
				}

			if($validity == 1){
				// print("********************* end of putIntoGroup function **********************\n\n");
				// print("found this group: ");
				// print($i+1);
				// print("for: ");
				// print($mentor_id);
				// print("<br>");
				return $group_to_test;
			}
		}
		// print("********************* end of putIntoGroup function **********************\n\n");
		// print("can't find a suitable group for: ");
		// print($mentor_id);
		// print("<br>");
		return $curr_num;
	}
}
}