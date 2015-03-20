<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\MatchGenerator;

//start_session();
//to get the priority array from weighted parameters page
// $weight = $_SESSION['weight'];
//to get the must array from weghted parameters page
//$must = $_SESSION['must'];

class MakeMatching extends Controller {

	protected $participants = array();


	public function generateMatchTest(){
		$william 	= array("LastName" => "hsiao",
						 "FirstName" => "william",
						 "pid" => "1",
						 "StudentNumber" => "32574113",
						 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
						 "interest" => array("game", "bigdata", "whatever"));
		$roy 		= array("LastName" => "hsiao",
						 "FirstName" => "roy",
						 "pid" => "2",
						 "StudentNumber" => "32574113",
						 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
						 "interest" => array("game", "bigdata", "whatever"));
		$billy		= array("LastName" => "hsiao",
						 "FirstName" => "billy",
						 "pid" => "3",
						 "StudentNumber" => "32574113",
						 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
						 "interest" => array("game", "bigdata", "whatever"));
		$niggaplz 	= array("LastName" => "hsiao",
						 "FirstName" => "niggaplz",
						 "pid" => "4",
						 "StudentNumber" => "32574113",
						 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
						 "interest" => array("game", "bigdata", "whatever"));
		$troy		= array("LastName" => "hsiao",
						 "FirstName" => "troy",
						 "pid" => "5",
						 "StudentNumber" => "32574113",
						 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
						 "interest" => array("gafweme", "bifewfegdata", "whafewfewtever"));
		$bob 		= array("LastName" => "hsiao",
						 "FirstName" => "bob",
						 "pid" => "6",
						 "StudentNumber" => "32574113",
						 "KickOffAvailibility" => array("2014-01-01", "2014-01-02"),
						 "interest" => array("game", "bigdata", "whatever"));

		$mentors = array($william,$niggaplz);
		$seniors = array($roy,$troy);
		$juniors = array($billy,$bob);
		$must = array("KickOffAvailibility");
		$priority = array("interest");
		$generator = new MatchGenerator($mentors,$seniors,$juniors,$must,$priority);
		echo $generator->generate();
		return 0;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
