<?php

class MatchMakingTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testMatching()
	{
		print("\nstarted testMatching\n");
		$response = $this->action('GET', "MakeMatching@generateMatchTest");
		print("end of testMatching\n\n");
		 echo $response;
	}
	// public function testUploadcsv(){
	// 	print("what is this shit\n");
	// 	$response = $this->action('GET', 'uploadCSVController@upload');
	// 	// echo $response;
	// }

}
