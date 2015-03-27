<?php namespace App\Services;

class MatchGenerator{

	/*
	|--------------------------------------------------------------------------
	| generate Trio match
	|--------------------------------------------------------------------------
	| this shit does the match
	| 
	|
	*/
	// participants 
	protected $mentors = array();
	protected $seniors = array();
	protected $juniors = array();

	// param for generator
	protected $mustList;
	protected $priority;

	//table for values
	protected $MentorSatTable = array();
	protected $memory = array();
	protected $backTrack = array();

	public function test(){
		// print("i made it to match-gen \n");
		// print ("test");
		// $this->getParticipant();
	}
	/**
	 * Create a new controller instance.
	 * @param list of all the participants 
	 * @param must list for this generator 
	 * @param priority list for this generator
	 * @return void
	 */
	public function __construct($mustList,$priority)
	{
		// $this->mentors = $mentors;
		// $this->seniors = $seniors;
		// $this->juniors = $juniors;
		
		// grab all the ids for mentor, senior and student from db
		// $this->getParticipant();
		
		// mock up now
		// $this->mentors = array(1,4);
		// $this->seniors = array(2,5);
		// $this->juniors = array(3,6);

		print("in constructor\n\n");
		$this->getParticipant();
		$this->mustList = $mustList;
		$this->priority = $priority;
	}
	/**
	 * get participants from db and init class field
	 * 
	 * @Void
	 */
	public function getParticipant(){
		print("********************* got into getParticipant *********************\n");

		$response_mentor= \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->select('participant.pid')
                                                  ->where('participant.pid', '<', '2640')
                                                  ->where('participant.pid', '>', '2634')
                                                  ->get();
        foreach ($response_mentor as $key => $value) {
        	$this->mentors[] = $value['pid'];
        }

		// print("***** mentor name *****\n");
		// foreach($this->mentors as $parti){
		// 	print($parti['First name']);
		// 	print("\n");
		// }

		$response_seniors = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->select('participant.pid')
                                                  ->where('participant.pid', '<', '2769')
                                                  ->where('participant.pid', '>', '2763')
                                                  ->get();

		foreach ($response_seniors as $key => $value) {
        	$this->seniors[] = $value['pid'];
        }
		// print("***** senior student name *****\n");                                          
		// foreach($this->seniors as $parti){
		// 	print($parti['First name']);
		// 	print("\n");
		// }

		$response_juniors = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->select('participant.pid')
                                                  ->where('participant.pid', '<', '2792')
                                                  ->where('participant.pid', '>', '2787')
                                                  ->get();
		
		foreach ($response_juniors as $key => $value) {
        	$this->juniors[] = $value['pid'];
        }
		// print("***** junior stuent name *****\n");
		// foreach($this->juniors as $parti){
		// 	print($parti['First name']);
		// 	print("\n");
		// }

		print("********************* getParticipant complete *********************\n\n");
	}


	/**
	 * start point of the generation of result 
	 * 
	 * @return result of the matching in format of array {[mid, sid, jid]}
	 */
	
	public function generate(){
		// $this->test();
		print("******************* in generate function *******************\n");
		$this->generateTable();
		//print("\ngeneratetable done");
		// $result = $this->doTheMatch($this->mentors, $this->seniors, $this->juniors);
		// print "\nDONE DO THE MATCH";
		// $this->doBackTrack($this->mentors, $this->seniors, $this->juniors);
		print("******************* end of genrate function *******************\n\n");
		return $result;
	}
    
    public function doBackTrack($mentors,$seniors,$juniors){
    	print("******************* in dobacktrack function *******************\n");
    	$key = implode(",", $mentors);
		$key .= ",";
		$key .= implode(",", $seniors);
		$key .= ",";
		$key .= implode(",", $juniors);
		// print ($key);
		if (array_key_exists($key, $this->backTrack)){
			$match = $this->backTrack[$key];
			print ("\n");
			print($match);
			$match_array = explode(",", $match);
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
		print("******************* end of dobacktrack function *******************\n\n");
		// var_dump($this->backTrack);
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
		print("******************* in dothematch function *******************\n");
		$key = implode(",", $mentors);
		$key .= ",";
		$key .= implode(",", $seniors);
		$key .= ",";
		$key .= implode(",", $juniors);
		print("\n");
		print ($key);
		if (array_key_exists($key, $this->memory)){
			print("\nresult exist");
			print("******************* in dothematch function *******************\n\n");
			return  $this->memory[$key];
		}else{
			print("\ncompute");
			$this->memory[$key] = $this->doTheMatch_compute($mentors,$seniors,$juniors);
			print("******************* in dothematch function *******************\n\n");
			return $this->memory[$key];
		}
	}
	
	public function doTheMatch_compute($mentors,$seniors,$juniors){
		// match a mentor each time
		print("******************* in doTheMatch function *******************\n");
		// print ("\ndoTheMatch with parameter: ");
		// print ("\nmentor:");
		// var_dump($mentors);
		// print ("\n senior:");
		// var_dump($seniors);
		// print ("\n junior:");
		// var_dump($juniors);

		$target = array_values($mentors)[0];
		print ("\ntarget:");
		print($target);
		// base case 	
		if (count($mentors) == 1){
			// return the key with the maxx vlaue 
			//should sotre the key somewhere for backtracking
			$key = $this->maxAvailiable($seniors,$juniors,$this->MentorSatTable[$target]); 
			$value = $this->MentorSatTable[$target][$key]; 
			
			$backTrackkey = implode(",", $mentors);
			$backTrackkey .= ",";
			$backTrackkey .= implode(",", $seniors);
			$backTrackkey .= ",";
			$backTrackkey .= implode(",", $juniors);
			$this->backTrack[$backTrackkey] = $key;
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
					print("\ndo matching with key:");
					print($key);
					// var_dump($this->MentorSatTable[$target][$key]);
					$temp = $this->MentorSatTable[$target][$key] + $this->doTheMatch($mod_mentors,$mod_seniors,$mod_juniors);
					$result[$key] = $temp; 
					
				}
			}
			// not using this mentor
			// call doTheMatch without this mentor, senior and junior remains 
			$without = $this->doTheMatch($mod_mentors,$seniors,$juniors);
			$with = max($result);

			if($with > $without){
				$choice = array_keys($result,$with);
				$backTrackkey = implode(",", $mentors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $seniors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $juniors);
				$this->backTrack[$backTrackkey] = $choice[0];
				print("******************* done with doTheMatch function *******************\n\n");
				return $with; 
			}else{
				$choice = "no including mentor " . $target;
				$backTrackkey = implode(",", $mentors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $seniors);
				$backTrackkey .= ",";
				$backTrackkey .= implode(",", $juniors);
				$this->backTrack[$backTrackkey] = $choice;
				print("******************* done with doTheMatch function *******************\n\n");
				return $without;
			}
		}
	}
	/**
	 * return an copy of the given array with out the given key
	 *
	 * @param list of available senior student
	 * @param list of available junior student
	 *
	 * @return the key that holds the maximum value in $targetArray
	 */
	public function array_without($array,$victim){
		$result = $array; 
		// something about unset
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
	 *
	 * @return the key that holds the maximum value in $targetArray
	 */
	public function maxAvailiable($seniors,$juniors,$targetArray){
		$temp = $targetArray;
		// sort it low to high
		arsort($temp);
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
	public function generateTable(){
		print("******************* in generateTable function *******************\n");
		foreach ($this->mentors as $mentor) {
			print("in loop level 1\n");
			$temp = array();
			foreach ($this->seniors as $senior) {
				print("in loop level 2\n");
				foreach ($this->juniors as $junior) {
					print("in loop level 3\n");
					$key = $mentor . "," . $senior . "," . $junior;
					print("in loop level 3\n");
					$satisfaction = $this->trioMatch($mentor,$senior,$junior);
					print("in loop level 3\n");
					$temp[$key] = $satisfaction;
					print("end of loop level 3\n");
				}
				print("end of loop level 2\n");
			}
			print("end of loop level 1\n");

			$this->MentorSatTable[$mentor] = $temp;
		}
		// print ("done generateTable with table:\n");
		print("******************* end of generateTable function *******************\n\n");
		var_dump($this->MentorSatTable);
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
		print("************************** in trioMatch ***********************\n");
		$A = $this->getPersonWithID($personA);
		$B = $this->getPersonWithID($personB);
		$C = $this->getPersonWithID($personC);


		$total = $this->match($A,$B) + 
				 $this->match($B,$C) +
				 $this->match($A,$C);
				 print("************************** end of trioMatch ***********************\n\n");
		return $total / 3 ;
	}

	/**
	 * get the person's information from db  
	 *
	 * @param participant's id
	 * 
	 * @return array of person's information 
	 */
	public function getPersonWithID($id){
		print("************************** in getPersonWithID ***********************\n");

		// mock up now
		// $william 	= array("LastName" => "hsiao",
		// 				 "FirstName" => "william",
		// 				 "pid" => "1",
		// 				 "StudentNumber" => "32574113",
		// 				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
		// 				 "interest" => array("game", "bigdata", "whatever"));
		// $roy 		= array("LastName" => "hsiao",
		// 				 "FirstName" => "roy",
		// 				 "pid" => "2",
		// 				 "StudentNumber" => "32574113",
		// 				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
		// 				 "interest" => array("game", "bigdata", "whatever"));
		// $billy		= array("LastName" => "hsiao",
		// 				 "FirstName" => "billy",
		// 				 "pid" => "3",
		// 				 "StudentNumber" => "32574113",
		// 				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
		// 				 "interest" => array("game", "bigdata", "whatever"));
		// $niggaplz 	= array("LastName" => "hsiao",
		// 				 "FirstName" => "niggaplz",
		// 				 "pid" => "4",
		// 				 "StudentNumber" => "32574113",
		// 				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
		// 				 "interest" => array("game", "bigdata", "whatever"));
		// $troy		= array("LastName" => "hsiao",
		// 				 "FirstName" => "troy",
		// 				 "pid" => "5",
		// 				 "StudentNumber" => "32574113",
		// 				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
		// 				 "interest" => array("gafweme", "bifewfegdata", "whafewfewtever"));
		// $bob 		= array("LastName" => "hsiao",
		// 				 "FirstName" => "bob",
		// 				 "pid" => "6",
		// 				 "StudentNumber" => "32574113",
		// 				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
		// 				 "interest" => array("game", "bigdata", "whatever"));

		// switch ($id){
		// 	case "1" :
		// 		return $william;
		// 		break;
		// 	case "2" :
		// 		return $roy;
		// 		break;
		// 	case "3" :
		// 		return $billy;
		// 		break;
		// 	case "4" :
		// 		return $niggaplz;
		// 		break;
		// 	case "5" :
		// 		return $troy;
		// 		break;
		// 	case "6" :
		// 		return $bob;
		// 		break;
		// }

		// return $person;

		//****************************************** everything below this in this function links to DB data ******************************************
		
		$junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
												  ->where('pid', '=', $id)
                                                  ->get();

        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', '=', $id)
                                                  ->get();

       	$mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid', '=', $id)
                                                  ->get();

        $result = array_merge($junior_result, $senior_result, $mentor_result);

        print("************************** end of getPersonWithID ***********************\n\n");
        return $result[0];
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
		print("******************* in match function *******************\n");
		// do must
		foreach ($this->mustList as $m){
			// print("in for loop level 1\n");
			// print("the value of m: ");
			// print($m);
			// print("\n");

			switch ($m){
				case "KickOffAvailibility":
					 if (!$this->dataAvalibility($personA["kickoff"],$personB["kickoff"])){
						// print("in kick off if statement\n");
						echo "here 0 ";
						return 0;
					}else{
						//for debugging purpose
						// print("in kick off if statement's else clause\n");
					}
					break;
				default :
					// print("in default case of switch in match function\n");	
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
					break;
			}
		}

		// print("done for loop; starting priority list shit\n");

		// do priority List
		$length = count($this->priority);
		// print("printing out length: ");
		// print($length);
		// print("\n");
		$weighting = count($this->priority);
		// print("printing out weighting: ");
		// print($weighting);
		// print("\n");
		$totalWeight = (($length+1)*$length)/2; 
		// print("printing out totalweight: ");
		// print($totalWeight);
		// print("\n");
		$priorityResult = 0;

		 print(("entering for loop with counter and shit\n"));

		// print($this->priority[0]);	
		// print("\n");

		for($counter = 0 ; $counter < $length; $counter++){
			// print(("entered for loop\n"));
			$try = $this->priority[$counter];
			$pAinterest = explode(",", $personA[$try]);
			// print(("entered for loop\n"));
			$pBinterest = explode(",", $personB[$try]);
			// print(("entering for loop with counter and shit\n"));
			$similiraity = $this->array_similarity($pAinterest,$pBinterest);
			$priorityResult += $similiraity*$weighting;
			$weighting--;
			// print(("end of for loop\n"));
		}

		 print("quit for loop successfully and the value of final result will be: ");
		// print(50+50*$priorityResult/$totalWeight);
		// print("\n");

		$priorityResult = $priorityResult/$totalWeight;
		$finalResult = 50 + 50*$priorityResult;


		// average the two and return
		print("******************* end of match function *******************\n\n");
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
		print("******************* got into dataAvailability *******************\n");
		$william = explode(",", $a1);
		$黃麗玲 = explode(",", $a2);
		$result = array_intersect($william, $黃麗玲);
		if (is_array($result) && (count($result)>0)){
			print("******************* end of dataAvailability true *******************\n\n");
			return true;
		}else{
			print("******************* end of dataAvailability false *******************\n\n");
			return false;
		}
	}
}