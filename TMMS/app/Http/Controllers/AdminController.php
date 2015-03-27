<?php namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\EditParticipantRequest;

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
//        $result = \DB::table('log')->orderBy('logID','desc')->get();
        // Return view with log array
        return \View::make('log');
    }

    public function viewLog2()
    {
        // Make select call to log table
        $retrieveAmount = $_POST["numRetrieve"];
        $result = \DB::table('log')->take($retrieveAmount)->orderBy('logID','desc')->get();
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

    public function showParticipant($pid) 
    {
        // Gets all mentor senior and junior students possible data 
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid',$pid)->get();
        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        //json parse the parameter data 
        $extra_decoded = json_decode($json_extra, true);
        $participant_result = array_merge($junior_result, $senior_result);

        return \View::make('participant')->with('participant_result', $participant_result)->with('json_extra', $json_extra);
    }

    public function editParticipant(EditParticipantRequest $request, $pid)
    {
        // Append these 2 fields because there is only one kickoff column
        $kickoff_data = $request['kickoff'].$request['kickoffcomments'];

        //Update columns in participant table
        \DB::table('participant')->where('pid', $pid)
                                 ->update(['email' => $request['email'],
                                           'gender' => $request['gender'],
                                           'birth year' => $request['birthyear'],
                                           'phone' => $request['phone'],
                                           'phone alt' => $request['phonealt'],
                                           'kickoff' => $kickoff_data,
                                           'genderpref' => $request['genderpref'],
                                           'past participation' => $request['pastparticipation'],
                                           ]);

        // Query here because need to fetch the keys (ex. CS Areas of Interest)
        // CURRENT DATA IN DATABASE PRE-EDITED
        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        // Decode JSON format of the extra column, then populate an array of keys 
        $extra = json_decode($json_extra, true);
        $extra_keys = array_keys($extra);

        // Make array for json_encode
        $extra_update = array();

        //populate array
        foreach($extra_keys as $key)
        {
            if ($key == "SID" || $key == "Time") 
            {
                // maintain original data
                $extra_update[$key] = $extra[$key];
            }
            else
            {
                //the actual edit takes place here
                //for some reason null values if not trimmed
                $no_spaces_key = preg_replace('/\s+/', '', $key);
                $extra_update[$key] = $request[$no_spaces_key];
            }
        }

        $encoded_extra_update = json_encode($extra_update);

        \DB::table('parameter')->where('pid', $pid) 
                               ->update(['extra' => $encoded_extra_update]);


        $jid = \DB::table('junior')->where('jid', $pid)->pluck('jid');

        // UPDATE PARTICIPANT IF JUNIOR STUDENT 
        if ($jid == $pid) 
        {
            \DB::table('junior')->where('jid', $pid)
                                ->update(['studentNum' => $request['studentnum'],
                                          'yearStand' => $request['yearstanding'],
                                          'programOfStudy' => $request['program'],
                                          'courses' => $request['courses'],
                                          'csid' => $request['csid'],
                                          'coop' => $kickoff_data['coop']
                                          ]);
        }
        // UPDATE PARTICIPANT IF SENIOR STUDENT 
        else
        {
            \DB::table('senior')->where('sid', $pid)
                                ->update(['studentNum' => $request['studentnum'],
                                          'yearStand' => $request['yearstanding'],
                                          'programOfStudy' => $request['program'],
                                          'courses' => $request['courses'],
                                          'csid' => $request['csid'],
                                          'coop' => $kickoff_data['coop']
                                          ]);
        }

        // Gets all mentor senior and junior students possible data
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid', $pid)->get();


        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        $participant_result = array_merge($junior_result, $senior_result);

        return \View::make('participant')->with('participant_result', $participant_result)->with('json_extra', $json_extra);
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
