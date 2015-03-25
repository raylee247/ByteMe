<?php

class MatchMakingTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	// public function testMatching()
	// {
	// 	$response = $this->action('GET', "MakeMatching@generateMatchTest");
	// 	// echo $response;
	// }
	public function testUploadcsv(){
		print("what is this shit\n");
		$response = $this->action('GET', 'uploadCSVController@upload');
		// echo $response;
	}

}
