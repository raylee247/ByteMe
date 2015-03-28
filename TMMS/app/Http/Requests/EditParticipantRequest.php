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
				'flag'				=> 'required',
				'firstname'			=> 'required',
				'familyname'		=> 'required',
				'email'				=> 'required|email',
				'phone'				=> 'required',
				'phonealt'			=> 'required',
				'gender'			=> 'required',
				'birthyear'			=> 'required',
				'kickoff'			=> 'required',
				'genderpref'		=> 'required',
				'pastparticipation'	=> 'required',
				'interest'			=> 'required',
				'studentnum'		=> 'required_if:flag, student',
				'csid'				=> 'required_if:flag, student',
				'program'			=> 'required_if:flag, student',
				'yearstanding'		=> 'required_if:flag, student',
				'courses'			=> 'required_if:flag, student',
				'coop'				=> 'required_if:flag, student',
				'yearofcs'			=> 'required_if:flag, student',
				'job'				=> 'required_if:flag, mentor',
				'edulvl'			=> 'required_if:flag, mentor',
			];
		
	}

}
