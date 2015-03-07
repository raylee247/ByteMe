<?php namespace App\Http\Middleware;


class GenerateTrioMatch extends Controller {

	/*
	|--------------------------------------------------------------------------
	| generate Trio match
	|--------------------------------------------------------------------------
	| this shit does the match
	| 
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// i dont think i even need one 
	}

	/**
	 * compute the statisfactoion rate of two provided person 
	 *
	 * @param First person to match
	 * @param Second person to match
	 * @param list of parameter that must be met by this pair
	 * @param list of parameter, order in priority 
	 * 
	 * @return statisfaction rate 
	 */
	public function match($personA,$personB,$mustList,$priority){

		// do must
		foreach ($mustList as $m){
			if ($m == "KickOffAvailibility" && !(dataAvalibility($personA[$m],$personB[$m])))
				return 0;
			else if($personA[$m] != $personB[$m])
					return 0;
		}

		// do priority List
		$length = count($priority);
		$weighting = count($priority);
		$totalWeight = (($length+1)*$length)/2; 
		$priorityResult = 0;
		
		for($counter = 0 ; $counter < $length; $counter++){
			$similiraity = array_similarity($personA[$priority[$counter],$personB[$priority[$counter]]);
			priorityResult += $similiraity*$weighting;
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