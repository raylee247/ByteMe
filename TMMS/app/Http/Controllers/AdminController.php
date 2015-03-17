<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;

class AdminController extends Controller {

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
        return view('admin');
    }

    public function studentsview()
    {
        return view('students');
    }
   
    public function mentorsview()
    {
        return view('mentors');
    }

     public function waitlist()
    {
        return view('waitlist');
    }



    public function downloadcsv()
    {

        // TODO: Update this function to be able to specify the CSV that we want.
        //      Probably after extracting data from table and creating a CSV we can decide on some concrete logic for this section.
        //      For now just downloads TestingCSV.csv from public/

        $file= public_path(). "/TestingCSV.txt";
        $headers = array(
            'Content-Type: text/plain',
        );
        return response()->download($file, 'TestingCSV.txt', $headers);
    }

}
