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

    public function viewLog()
    {
        // Make select call to log table
        $result = \DB::table('log')->get();
        // Return view with log array
        return \View::make('log')->with('result',$result);
    }

    public function studentSearch(){
        $dropdown = $_POST['search_param'];
        $text = $_POST['text'];
        $pattern = '/([1-9][0-9]{7})|([a-z][0-9][a-z][0-9])|([a-zA-Z]+\ ?[a-zA-Z]*)/';

        preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);

        $matches = $matches[0][0];
        echo $matches;
        echo "<br>";
        echo $text;
        echo "<br>";
        if(strcmp($text, $matches) != 0){
            echo "input error, please make sure the input value is a name, student number or cs-id";
        }else{
            if(strcmp($dropdown, "junior students") == 0){
                echo "search junior student";
            }

            if(strcmp($dropdown, "senior students") == 0){
                echo "search senior student";
            }

            if(strcmp($dropdown, "all") == 0){
                echo "search all";
            }
        }
    }

    public function downloadcsv()
    {
        return view('downloadcsv');
    }

    public function downloadCSVfile()
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
