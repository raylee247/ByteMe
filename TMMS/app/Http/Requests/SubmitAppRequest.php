<?php namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitAppRequest extends FormRequest {

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
		'email' => 'required|unique:participant,email ',
		'studentnum' => 'required|unique:participant',
		'csid' => 'required'
		'givenname' => 'required',
		'familyname' => 'required',
		'sex' => 'required',
		'yearofstudy' => 'required',
		'programstudy' || 'otherprogramstudy' => 'required',
		'kickoffavail' => 'required',
		'courses' => 'required'


	
	








			//
		];
	}

}
