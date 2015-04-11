<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditParticipantRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/*

       Function: rules

       Get the validation rules that apply to the request

       Parameters:
       none

       Returns:
       An array of validation rules 

    */

	public function rules()
	{
		$email = \Input::input('email');

			return [
				'flag'				=> 'required',
				'firstname'			=> 'required|alpha_dash',
				'familyname'		=> 'required|alpha_dash',
				'email'				=> 'required|email|unique:participant,email,NULL,id,email,'.$email,
				'phone'				=> 'required|digits:10',
				'gender'			=> 'required',
				'kickoff'			=> 'required',
				'genderpref'		=> 'required',
				'pastparticipation'	=> 'required',
				'interest'			=> 'required',
				'studentnum'		=> 'required_if:flag, student|digits:8',
				'csid'				=> 'required_if:flag, student|regex:"^[a-z][0-9][a-z][0-9]$',
				'program'			=> 'required_if:flag, student',
				'yearstanding'		=> 'required_if:flag, student',
				'coop'				=> 'required_if:flag, student',
				'yearofcs'			=> 'required_if:flag, student',
				'edulvl'			=> 'required_if:flag, mentor',
			];
	}
}
