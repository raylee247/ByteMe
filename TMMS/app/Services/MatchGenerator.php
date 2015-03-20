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
	public function __construct($mentors,$seniors,$juniors,$mustList,$priority)
	{
		$this->mentors = $mentors;
		$this->seniors = $seniors;
		$this->juniors = $juniors;
		$this->mustList = $mustList;
		$this->priority = $priority;
		echo "wat";
	}

	/**
	 * start point of the generation of result 
	 * 
	 * @return result of the matching in format of array {[mid, sid, jid]}
	 */
	
	public function generate(){
		
		$this->generateTable();

		$result = doTheMatch(array(1,4),array(2,5),array(3,6));

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
			// return the key with the maxx vlaue 
			//should sotre the key somewhere for backtracking
			$key = maxAvailiable($MentorSatTable[$target]); 

			$value = $MentorSatTable[$target][$key]; 
			return $value;
		}else{
			// find max of all combination for this mentor at this level 
			// max( not using this mentor, using this mentor)
			// in the using this mentor case, we want the max(all possible combination)
			$result = array();
			// using this mentor 
			// for all the match possible for this mentor, for example, <mentorA, seniorA, junior A>
			// call doTheMatch($mentors - mentorA ,$seniors - SeniorA ,$juniors - JuniorA )
			// return the maximum value of the cases 
			$mod_mentors = array_without($mentors,$target);
			foreach ($seniors as $senior) {
				foreach ($juniors as $junior) {
					// call dotheMatch 
					$mod_seniors = array_without($seniors,$senior);
					$mod_juniors = array_without($juniors,$junior);
					$key = $target . "," . $senior . "," . $junior;
					$temp = $MentorSatTable[$target][$key] + doTheMatch($mod_mentors,$mod_seniors,$mod_juniors);
					$result[] = $temp; 
				}
			}
			// not using this mentor
			// call doTheMatch without this mentor, senior and junior remains 
			$without = doTheMatch($mod_mentors,$seniors,$juniors);
			$with = max($result);

			if($with > $without){
				return $with; 
			}else{
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
	public function array_without($array,$key){
		$result = $array; 
		// something about unset
		unset($result[$key]);
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
			if (($value > $result) && (in_array($senior, $seniors)) && (in_array($junior, $juniors))){
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
		foreach ($this->mentors as $mentor) {
			$temp = array();
			foreach ($this->seniors as $senior) {
				foreach ($this->juniors as $junior) {
					$key = $mentor['pid'] . "," . $senior['pid'] . "," . $junior['pid'];
					$satisfaction = $this->trioMatch($mentor,$senior,$student);
					//if ($satisfaction > 49){
						$temp[$key] = $satisfaction;
					//} 
				}
			}
			$this->MentorSatTable[$mentor['pid']] = $temp;
		}

		var_dump($MentorSatTable);
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
	 * compute the satisfaction rate of two provided person 
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