<?php
$personA = array("LastName" => "hsiao",
				 "FirstName" => "william",
				 "StudentNumber" => "32574113",
				 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
				 "interest" => array("game", "bigdata", "whatever"));

$personB = array("LastName" => "hsiao",
				 "FirstName" => "william",
				 "StudentNumber" => "32574113",
				 "KickOffAvailibility" => array("2014-01-01", "2014-01-04"),
				 "interest" => array("GAME", "big data"));

$must = array("KickOffAvailibility","StudentNumber");
$priority = array("interest");

echo match($personA,$personB,$must,$priority);

function printInfo($var){
	foreach ($var as $key => $value) {
	if(is_array($value)){
		echo "key: " . $key . "\n";
		foreach ($value as $innerValue) {
			echo "value: " . $innerValue . "\n";
		}
	}else{
		echo "key: " . $key . "\n";
		echo "value: " . $value . "\n";
	}
	
}
}


function match($personA,$personB,$mustList,$priority){

		// do must
		foreach ($mustList as $m){
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
		$length = count($priority);
		$weighting = count($priority);
		$totalWeight = (($length+1)*$length)/2; 
		$priorityResult = 0;
		
		for($counter = 0 ; $counter < $length; $counter++){
			$similiraity = array_similarity($personA[$priority[$counter]],$personB[$priority[$counter]]);
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
function array_similarity(Array $a1, Array $a2){
	
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
function dataAvalibility(Array $a1, Array $a2){
		$result = array_intersect($a1, $a2);
		if (is_array($result) && (count($result)>0)){
			return true;
		}else{
			return false;
		}
}


?>