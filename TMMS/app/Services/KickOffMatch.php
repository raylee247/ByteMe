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

	/**
	 * Create a new controller instance.
	 * @param list of all the participants 
	 * @param must list for this generator 
	 * @param priority list for this generator
	 * @return void
	 */
	public function __construct($max, $mentor_per_group)
	{
		// print("********************* in constructor **********************\n");
		$this->current_matches  = \DB::table('report')->where('report.year', '=', date('Y'))->get();
		$this->max_participant = $max;
		$this->mentorsInGroup = $mentor_per_group;
		$this->fullMentorTable = \DB::table('mentor')->get();
		$this->participantTable = \DB::table('participant')->get();

		$kickoffnights = array();
		$allparticipant = \DB::table('participant')->where('participant.year', '=', date('Y'))->get();
		$participantkickoff;

		foreach($allparticipant as $participant){
			if(empty($participantkickoff)){
				$participantkickoff = $participant["kickoff"];
			}else{
				$participantkickoff = $participantkickoff.",".$participant["kickoff"];
			}

		}

		$kickoffnights = array_unique(explode(",", $participantkickoff));

		// print("printing kickoffnight");
		// var_dump($kickoffnights);

		foreach ($kickoffnights as $key => $value){
			if(strcmp($value, "1111") == 0){
				unset($kickoffnights[$key]);
			}else{
				if(strcmp($value, "Kickoff Date") == 0){
					unset($kickoffnights[$key]);
				}else{
					if(strcmp($value, "09-09-9282") == 0){
						unset($kickoffnights[$key]);
					}else{
						if(strcmp($value, "") == 0){
						unset($kickoffnights[$key]);
					}
					}
				}
			}
		}

		// print("\n");
		// print("printing kickoffnight");
		// var_dump($kickoffnights);
		// print("\n");

		foreach ($kickoffnights as $value) {
			array_push($this->kick_off_nights, $value);
		}

		// print("\n");
		// print("printing kickoffnight");
		// var_dump($this->kick_off_nights);
		// print("\n");

		$this->num_of_nights = count($this->kick_off_nights);

		// var_dump($kickoffnights);

		for($i = 0; $i < $this->num_of_nights; $i++){
			array_push($this->ppl_p_night, $this->max_participant);
			$newkey = $this->kick_off_nights[$i];
			$this->ppl_p_night[$newkey] = $this->ppl_p_night[$i];
			unset($this->ppl_p_night[$i]);
		}

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
	 * start point of the generation of result 
	 * 
	 * @return result of the matching in format of array {[mid, sid, jid]}
	 */
	
	public function generate(){
		// $this->test();
		// print("********************* in generate function **********************\n");
		ini_set('memory_limit', '1000M');
		set_time_limit(3600);
		$this->setKickOffDay();
		$response = $this->setGroup();
		// var_dump($response);
		// print("******************* end of genrate function *******************\n\n");
		return $response;
	}

	/**
	 * add a day for each trio matched pair
	 * 
	 * modifies and changes the current matches and add a attending date to all trio
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
	 * gets the available day of the trio, add to the array
	 * 
	 * modifies and changes the current matches and add a attending date to all trio
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

			$mentor_availableday = explode(",", $mentor_availableday);
			$senior_availableday = explode(",", $senior_availableday);
			$junior_availableday = explode(",", $junior_availableday);
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
	 * picks a particular kickoff day for the trio
	 * 
	 * modifies and changes the current matches and add a attending date to all trio
	 */
	public function pickday()
	{
		// print("********************* in pickday function **********************\n");
		for ($i = 0; $i<count($this->current_matches); $i++) {
			$element = $this->current_matches[$i];
			$dates = array_slice($element, 6);
			// var_dump($dates);
			if(count($dates)==1){
				$this->ppl_p_night[$dates[0]] = $this->ppl_p_night[$dates[0]]-3;
			}else{
					$day = $this->findBestDay($element);
					$element = array_slice($element, 0, 5);
					array_push($element, $day);
					// var_dump($element);
					$this->current_matches[$i] = $element;
				}
			}
		// print("********************* end of pickday function **********************\n\n");
	}

	/**
	 * picks a particular kickoff day for the trio if they have more that one commoon available day
	 * 
	 * modifies and changes the current matches and add a attending date to all trio
	 */
	public function findBestDay($element)
	{
		// print("********************* in findBestDay function **********************\n");
		//find the night with the least members
		$dates = array_slice($element, 6);
		$night;
		$max = -1;
		foreach($dates as $date){
			if($this->ppl_p_night[$date] > $max){
				$max = $this->ppl_p_night[$date];
				$night = $date;
			}
		}
		// var_dump($element);
		// array_push($element, $night);
		// var_dump($element);
		if($max == -1){
			foreach($this->ppl_p_night as $key => $value){
				if($value > $max){
					$max = $value;
					print($key);
					$night = $key;
				}
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
	 * populates All groups with its night as its key
	 * 
	 * 
	 */
	public function setGroup()
	{
		// print("********************* in setGroup function **********************\n");
		//set_time_limit(3600);
		$result = array();
		$count = 0;
		foreach($this->kick_off_nights as $night){
			//compute all the students and mentors attending this night's kickoff
			$kickoff_mentor = array();
			$kickoff_senior = array();
			$kickoff_junior = array();
			foreach($this->current_matches as $matches){
				if(strcmp($matches[5], $night)==0){
					array_push($kickoff_mentor, $matches[1]);
					array_push($kickoff_senior, $matches[2]);
					array_push($kickoff_junior, $matches[3]);
				}
			}
			$num_of_groups = floor(count($kickoff_mentor)/$this->mentorsInGroup);

			if($num_of_groups == 0){
				$num_of_groups = 1;
			}

			$resultofday = array();

			foreach($kickoff_mentor as $mentor_id){
				//put all the mentors into groups
				$counter = 0;
				$group;

				if(count($resultofday) == $num_of_groups){
					$group = $resultofday[$counter%$num_of_groups];
				}else{
					$group = array();
				}

				if(empty($group)){
					array_push($group, $mentor_id);
					array_push($resultofday, $group);
				}else{
					$validity = true;
					foreach($group as $group_member){
						$validity = $validity && $this->is_valid($mentor_id, $group_member);
					}

					if($validity){
						array_push($group, $mentor_id);
						$resultofday[$counter%$num_of_groups] = $group;
					}else{
						array_push($resultofday[$this->putIntoGroup($counter%$num_of_groups, $num_of_groups, $resultofday, $mentor_id)], $mentor_id);
					}
				}
				$counter++;
			}
			
			$counter = 1;
			foreach($kickoff_senior as $senior_id){
				//put all senior student into groups
				array_push($resultofday[$counter%$num_of_groups], $senior_id);
				$counter++;
			}

			$counter = 2;
			foreach($kickoff_junior as $junior_id){
				//put all senior student into groups
				array_push($resultofday[$counter%$num_of_groups], $junior_id);
				$counter++;
			}

			array_push($result, $resultofday);
			$newkey = $night;
			$result[$newkey] = $result[$count];
			unset($result[$count]);
			$count++;
		}

		// print("********************* end of setGroup function **********************\n\n");

		return $result;
	}

	public function is_valid($mentor1, $mentor2){
		// print("*********************  in is_valid function **********************\n\n");
		//set_time_limit(3600);

		$m1_company = "";
		$m1_job = "";
		$m2_company = "";
		$m2_job = "";

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
		}

		if(!empty($m1_job)){
			str_replace(" ", "", $m1_job);
			$m1_job = strtolower($m1_job);
		}

		if(!empty($m2_company)){
			str_replace(" ", "", $m2_company);
			$m2_company = strtolower($m2_company);
		}

		if(!empty($m2_job)){
			str_replace(" ", "", $m2_job);
			$m2_job = strtolower($m2_job);
		}




		if(($m1_job == $m2_job) || ($m1_company == $m1_company)){
			// print("********************* end of is_valid function **********************\n\n");
			return false;
		}else{
			// print("********************* end of is_valid function **********************\n\n");
			return true;
		}
	}

	public function putIntoGroup($curr_num, $group_total, $curr_group, $mentor_id){
		// print("********************* in putIntoGroup function **********************\n\n");
		$groups_tested = 1;
		for($i=$curr_num; $groups_tested < $group_total; $i++){
			$validity = true;
			foreach($curr_group as $group_member){
				$validity = $validity && $this->is_valid($mentor_id, $group_member);
			}

			if($validity){
				// print("********************* end of putIntoGroup function **********************\n\n");
				return $i;
			}
		}
		// print("********************* end of putIntoGroup function **********************\n\n");
		return $curr_num;
	}
    
}