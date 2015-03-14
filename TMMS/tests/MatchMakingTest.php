<?php

class MatchMakingTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testStructure()
	{
		$response = $this->action('GET', "MakeMatching@generateMatch");
		echo $response;
	}

}
