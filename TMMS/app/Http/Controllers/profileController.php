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
		//
	}

	/**
	 * Edit the participant information
	 *
	 * @return Response
	 */
	public function editParticipant()
	{
		//
	}

	/**
	 * Remove participant from current year's tri-mentoring program
	 *
	 * @return Response
	 */
	public function deleteParticipant()
	{
		//
	}

	/**
	 * Move participant from participant pool to waitlist pool
	 *
	 * @return Response
	 */
	public function toWaitlist()
	{
		//
	}

	/**
	 * Move participant from waitlist pool to participant pool
	 *
	 * @return Response
	 */
	public function toParticipantPool()
	{
		//
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
	 * Retrieve all participants in the waitlist to display
	 *
	 * @return Response
	 */
	public function getWaitlist()
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
        //
    }

}
