<?php namespace App\Http\Controllers;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /*

        Function: __construct

        On contruction of all controller pages it will check for authorization for the page

        Parameters:
        none

        Returns:
        none

    */
	public function __construct()
	{
		$this->middleware('auth');
	}

    /*

        Function: index

        Returns the home page

        Parameters:
        none

        Returns:
        Home page

    */
	public function index()
	{	
		$preview_header = array();
		$preview_data = array();
		return view('home',compact('preview_header','preview_data'));
	}

}
