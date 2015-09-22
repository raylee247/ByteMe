<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class aboutController extends Controller {

    /*

        Function: index

        Returns the about page view

        Parameters:
        none

        Returns:
        About page view

    */
	public function index()
	{
		return View('about');
	}

}
