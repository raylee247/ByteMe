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

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'firstname'			=> 'required',
			'familyname'		=> 'required',
			'email'				=> 'required|email',
			'studentnum'		=> 'required',
			'csid'				=> 'required',
			'phone'				=> 'required',
			'phonealt'			=> 'required',
			'gender'			=> 'required',
			'birthyear'			=> 'required',
			'kickoff'			=> 'required',
			'kickoffcomments'	=> 'required',
			'genderpref'		=> 'required',
			'program'			=> 'required',
			'yearstanding'		=> 'required',
			'courses'			=> 'required',
			'pastparticipation'	=> 'required',
			'coop'				=> 'required',
			'interest'			=> 'required'
		];
	}

}
