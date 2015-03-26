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
        $this->middleware('auth');
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
        
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')->get();   
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')->get();
                                                  
        $result = array_merge($junior_result, $senior_result);

        return \View::make('students')->with('result', $result);
    }
   
    public function mentorsview()
    {
        $result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')->get();
        return \View::make('mentors')->with('result', $result); 
    }

     public function waitlist()
    {
        $date = date("Y");
        $result = \DB::table('participant')->where('waitlist', 1)->where('year', $date)->get();
        
        return \View::make('waitlist')->with('result', $result);
    }

    public function viewLog()
    {
        // Make select call to log table
        $result = \DB::table('log')->get();
        // Return view with log array
        return \View::make('log')->with('result',$result);
    }

    public function studentSearch()
    {
        $dropdown = $_POST['search_param'];
        $text = $_POST['text'];
        //validates search param 
        // $pattern = '/([1-9][0-9]{7})|([a-z][0-9][a-z][0-9])|([a-zA-Z]+\ ?[a-zA-Z]*)/';

        // preg_match($pattern, $text, $matches, PREG_OFFSET_CAPTURE);

        // $matches = $matches[0][0];
        // if(strcmp($text, $matches) != 0)
        // {
        //     echo "input error, please make sure the input value is a name, student number or cs-id";
        // }
        // else
        // {
        //     if(strcmp($dropdown, "junior students") == 0){
        //         echo "search junior student";
        //     }

        //     if(strcmp($dropdown, "senior students") == 0){
        //         echo "search senior student";
        //     }

        //     if(strcmp($dropdown, "all") == 0){
        //         echo $dropdown; 
        //         echo "<br>";
        //         echo $text;
        //         echo "<br>";
        //         echo $pattern;
        //         echo "<br>";
        //     }
        // }
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('First name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('studentNum', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('csid', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('email', 'LIKE', '%'.$text.'%')
                                                  ->get();

        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('First name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('studentNum', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('csid', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('email', 'LIKE', '%'.$text.'%')
                                                  ->get();
        
        if (strcmp($dropdown, "junior students") == 0) 
        {
            //result query - joins participant table with junior student 
            $result = $junior_result;
        }

        else if (strcmp($dropdown, "senior students") == 0) 
        {
            //result query - joins participant table with senior student 
            $result = $senior_result;
        }
        else 
        {
            $result = array_merge($junior_result, $senior_result);
        }

        return \View::make('students')->with('result', $result);
    }

    //TODO: regex to check for correct input? <- not sure if necessary 
    public function mentorSearch()
    {
        $text = $_POST['text'];

        $result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                           ->where('First name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('email', 'LIKE', '%'.$text.'%')
                                           ->get();

        return \View::make('mentors')->with('result', $result);
    }

    public function waitlistSearch()
    {
        $text = $_POST['text'];

        $result = \DB::table('participant')->where('First name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('Family name', 'LIKE', '%'.$text.'%')
                                           ->orWhere('email', 'LIKE', '%'.$text.'%')
                                           ->get();

        return \View::make('waitlist')->with('result', $result);
    }

    //test function
    public function indexParticipant() 
    {

    }

    public function showParticipant($pid) 
    {
        $participant_result = \DB::table('participant')->where('pid', $pid)->get();

        return \View::make('participant')->with('participant_result', $participant_result);
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
