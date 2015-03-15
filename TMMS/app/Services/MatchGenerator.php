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
	protected $mentors;
	protected $seniors;
	protected $juniors;

	// param for generator
	protected $mustList;
	protected $priority;

	//table for values
	protected $MentorSatTable;


	public function test(){
		return "i made it to match-gen";
	}
	/**
	 * Create a new controller instance.
	 * @param list of all the participants 
	 * @param must list for this generator 
	 * @param priority list for this generator
	 * @return void
	 */
	public function __construct($participants,$mustList,$priority)
	{
		categorize($participants);
		$this->mustList = $mustList;
		$this->priority = $priority;
	}
	/**
	 * seperate participants in to mentor, senior student and junior student
	 *
	 * @param list of participants 
	 * 
	 * @return satisfaction rate 
	 */
	public function categorize($participants){
		// parse $participants in a way such that we categorize them 
		//TODO

		//dummy actions 
		$this->mentors = array();
		$this->seniors = array();
		$this->juniors = array();
	}


	/**
	 * start point of the generation of result 
	 * 
	 * @return result of the matching in format of array {[mid, sid, jid]}
	 */
	
	public function generate(){
		generateTable();

		$result = doTheMatch($this->mentors,$this->seniors,$this->juniors);

		return $result;
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
		// match a mentor each time
		$target = $mentors[0];
		// base case 	
		if (count($mentors) == 1){
			// return the key of max array
			$match = array_keys($this->MentorSatTable[$target], max($this->MentorSatTable[$target]));
			// problem : max combination might not be available since other match might have take it
			return $match[0];
		}else{
			// find max of all combination for this mentor at this level 
			// max( not using this mentor, using this mentor)
			// in the using this mentor case, we want the max(all possible combination)
			
			// not using this mentor
			// call doTheMatch without this mentor, senior and junior remains 


			// using this mentor 
			// for all the match possible for this mentor, for example, <mentorA, seniorA, junior A>
			// call doTheMatch($mentors - mentorA ,$seniors - SeniorA ,$juniors - JuniorA )
			// return the maximum value of the cases 

		}
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
		foreach ($this->mentors as $mentor) {
			$temp = array();
			foreach ($this->seniors as $senior) {
				foreach ($this->juniors as $junior) {
					$key = $mentor . "," . $senior . "," . $junior;
					$temp[$key] = trioMatch($mentor,$senior,$student);
				}
			}
			$this->MentorSatTable[$mentor] = $temp;
		}
	}

	/**
	 * compute the statisfactoion rate of two provided person 
	 *
	 * @param First person to match
	 * @param Second person to match
	 * @param third person to match
	 * 
	 * @return satisfaction rate 
	 */
	public function trioMatch($personA, $personB, $personC){
		$A = getPersonWithID($personA);
		$B = getPersonWithID($personB);
		$C = getPersonWithID($personC);

		$total = match($A,$B) + 
				 match($B,$C) +
				 match($A,$C);
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
		// get the person's info from db somehow 
		$person = array();
		return $person;
	}
	/**
	 * compute the statisfactoion rate of two provided person 
	 *
	 * @param First person to match
	 * @param Second person to match
	 * 
	 * @return satisfaction rate 
	 */
	public function match($personA,$personB){

		// do must
		foreach ($this->mustList as $m){
			switch ($m){
				case "KickOffAvailibility":
					if (!dataAvalibility($personA["KickOffAvailibility"],$personB["KickOffAvailibility"])){
						echo "here 0 ";
						return 0;
					}
					break;
				default :
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

		// do priority List
		$length = count($this->priority);
		$weighting = count($this->priority);
		$totalWeight = (($length+1)*$length)/2; 
		$priorityResult = 0;
		
		for($counter = 0 ; $counter < $length; $counter++){
			$similiraity = array_similarity($personA[$this->priority[$counter]],$personB[$this->priority[$counter]]);
			$priorityResult += $similiraity*$weighting;
			$weighting++;
		}

		$priorityResult = $priorityResult/$totalWeight;
		$finalResult = 50 + 50*$priorityResult;


		// average the two and return
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
	public function array_similarity(Array $a1, Array $a2){
	
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
		var_dump($a1_local);
		var_dump($a2_local);
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
	public function dataAvalibility(Array $a1, Array $a2){
		$result = array_intersect($a1, $a2);
		if (is_array($result) && (count($result)>0)){
			return true;
		}else{
			return false;
		}
	}
}