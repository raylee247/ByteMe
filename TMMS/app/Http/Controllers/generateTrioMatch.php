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
	public function match(JSON $personA, JSON $personB, Array $mustList, Array $priority){

		// do must
		foreach ($mustList as $m){
			if ($m == "kickoff availibility" && !(dataAvalibility($personA->{$m},$personB->{$m})))
				return 0;
			else if($personA->{$m} != $personB->{$m})
					return 0;
		}
		// do priority List
		$length = count($priority);
		$totalWeight = (($length+1)*$length)/2; 
		

		// average the two and return
		return result;
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

	}

	/**
	 * compute the if two given array has date in common 
	 *
	 * @param array 1
	 * @param array 2
	 * 
	 * @return similarity rate
	 */
	public function dataAvalibility(Array $a1, Array $a2){

	}
}