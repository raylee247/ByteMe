<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;

class StudentAppController extends Controller {

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('studentapp');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index2()    
    {
        $email = $_POST['email'];
        return view('studentapp')->with('email', $email);
    }



}
