<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class profileController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Remove participant from current year's tri-mentoring program
	 *
	 * @return Response
	 */
	public function deleteParticipant()
	{
        //retrieve email to do query on the participant to remove (email cause it is shared primary key)
		$email = $_GET['email'];
        $year = date("Y");
        //$email = "willy504@gmail.com";
        //$year = "2014";
        $rawApp = \DB::table('participant')->where('year', $year)->where('email', $email)->delete();

        //check if correctly removed
        if($rawApp > 1){
            $response = "removed too many";
        }if($rawApp < 1) {
            $response = "did nothing";
        }else{
            $response = "removed participant";
        }
	}

	/**
	 * Move participant from participant pool to waitlist pool
	 *
	 * @return Response
	 */
	public function toWaitlistPool()
	{
        //retrieve email to do query on the participant to remove (email cause it is shared primary key)
        //$email = $_GET['email'];
        //$year = date("Y");
        $email = "willy504@gmail.com";
        $year = "2014";
        $rawApp = \DB::table('participant')->where('year', $year)->where('email', $email)->update(array('waitlist'=> 1));

        //check if correctly updated
        if($rawApp > 1){
            $response = "updated too many";
        }if($rawApp < 1) {
            $response = "did nothing";
        }else{
            $response = "Moved into waitlist pool";
        }
	}

	/**
	 * Move participant from waitlist pool to participant pool
	 *
	 * @return Response
	 */
	public function toParticipantPool()
	{
        $email = "willy504@gmail.com";
        $year = "2014";
        $rawApp = \DB::table('participant')->where('year', $year)->where('email', $email)->update(array('waitlist' => 0));

        //check if correctly updated
        if($rawApp > 1){
            $response = "updated too many";
        }if($rawApp < 1) {
            $response = "did nothing";
        }else{
            $response = "Moved into participant pool";
        }
	}

	/**
	 * View participant past record
	 *
	 * @return Response
	 */
	public function participantPast()
	{
		//
	}


    /**
     * Remove specified year's data from database
     *
     * @return Response
     */
    public function removeYearData()
    {
        //retrieve email to do query on the participant to remove (email cause it is shared primary key)
        $year = date("Y");
        //$year = "2014";
        $rawApp = \DB::table('participant')->where('year', $year)->delete();

        //check if correctly removed
        if($rawApp < 1) {
            $response = "Did nothing";
        }else{
            $response = "Removed all participant data for " . $year;
        }
    }

}
