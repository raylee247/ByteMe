<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

    /*

        Function: __construct

        determines if user is a guest

        Parameters:
        none

        Returns:
        none

*/
	public function __construct()
	{
		$this->middleware('guest');
	}

    /*

        Function: index

        Returns the welcome page view

        Parameters:
        none

        Returns:
        welcome page view

    */
	public function index()
	{
		return view('welcome');
	}

    /*

        Function: hello

        Prints hello

        Parameters:
        none

        Returns:
        returns a string of Hello World

    */
	public function hello()
	{
		return 'Hello World!';
	}

}
