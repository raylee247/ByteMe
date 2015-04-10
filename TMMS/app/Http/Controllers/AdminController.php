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

    public function reportdownload()
    {
      $year = $_POST['year_report'];

      $download_dir = "downloadReport";
        if (is_dir($download_dir)) {
            $this->recursiveRemoveDirectoryFiles($download_dir);
        } else {
            mkdir($download_dir);
        }

      $reports = \DB::table('report')->where('year', '=', $year)->get();
      $participants = \DB::table('participant')->where('year', '=', $year)->get();


      $report_file_name = "downloadReport/report".$year.".txt";
      $report_file = fopen($report_file_name, "a");

      foreach($reports as $report){
        $mentorname;
        $seniorname;
        $juniorname;

        foreach($participants as $participant){
          if($report["mentor"] == $participant["pid"]){
            $mentorname = $participant["First name"]." ".$participant["Family name"];
          }
        }

        foreach($participants as $participant){
          if($report["senior"] == $participant["pid"]){
            $seniorname = $participant["First name"]." ".$participant["Family name"];
          }
        }


        foreach($participants as $participant){
          if($report["junior"] == $participant["pid"]){
            $juniorname = $participant["First name"]." ".$participant["Family name"];
          }
        }

        $write_string = "Mentor ".$mentorname." was paired with senior student ".$seniorname." and junior student ".$juniorname." in year ".$year.".";

        fwrite($report_file, $write_string);
        fwrite($report_file, "\r\n");

      }

      fclose($report_file);

      $download_file_zip = 'downloadReports.zip';
        $files = glob('downloadReport/*');
        \Zipper::make($download_file_zip)->add($files);
        \Zipper::close();

      //Send file
        $headers = array(
            'Content-Type: application/zip'
        );

        return response()->download("downloadReports.zip", "TMMSParticipantReports".$year.".zip", $headers);

    }

    public function studentsview()
    {
        $year = date("Y");
        // Retrieve junior and senior students from database
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('year', $year)
                                                  ->get();   
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('year', $year)
                                                  ->get();
                                                  
        // Merge these two results 
        $result = array_merge($junior_result, $senior_result);

        return \View::make('students')->with('result', $result);
    }
   
    public function mentorsview()
    {
        $year = date("Y");
        // Retrieve mentors from database
        $result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                           ->where('year', $year)   
                                           ->get();
        return \View::make('mentors')->with('result', $result); 
    }

     public function waitlist()
    {
        $date = date("Y");
        $result = \DB::table('participant')->where('year', $date)->get();
        
        // to persist search result 
        if(\Session::has('current_search')) {
          \Session::forget('current_search');
        }

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
        if (is_numeric($retrieveAmount)) {
            if ($retrieveAmount < 0) {
                $retrieveAmount = 10;
            }
        } else {$retrieveAmount = 10;}
        $result = \DB::table('log')->take($retrieveAmount)->orderBy('logID','desc')->get();
        // Return view with log array
        return \View::make('log')->with('result',$result);
    }

    public function studentSearch()
    {
        $dropdown = $_POST['search_param'];
        $text = $_POST['text'];
        $year = date("Y");
        $text_array = explode(" ", $text);
        $text2;
        if(preg_match("/[a-zA-Z]*( [a-zA-Z]*)?/", $text) && count($text_array) < 2){
          $text2 = $text;
        }else{
          $text = $text_array[0];
          $text2 = $text_array[1];
        }
        
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('year', $year)
                                                  ->where('First name', 'LIKE', '%'.$text.'%')
                                                  ->Where('Family name', 'LIKE', '%'.$text2.'%')
                                                  ->orWhere('studentNum', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('csid', 'LIKE', '%'.$text.'%')
                                                  ->orWhere('email', 'LIKE', '%'.$text.'%')
                                                  ->get();

        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('year', $year)
                                                  ->where('First name', 'LIKE', '%'.$text.'%')
                                                  ->Where('Family name', 'LIKE', '%'.$text2.'%')
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

        return \View::make('students')->with('result', $result)->with('search_param', $dropdown)->with('text', $text);
    }

    //TODO: regex to check for correct input? <- not sure if necessary 
    public function mentorSearch()
    {
        $text = $_POST['text'];
        $year = date("Y");
        $text_array = explode(" ", $text);
        $text2;
        if(preg_match("/[a-zA-Z]*( [a-zA-Z]*)?/", $text) && count($text_array) < 2){
          $text2 = $text;
        }else{
          $text = $text_array[0];
          $text2 = $text_array[1];
        }

        $result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                           ->where('year', $year)
                                           ->where('First name', 'LIKE', '%'.$text.'%')
                                           ->Where('Family name', 'LIKE', '%'.$text2.'%')
                                           ->orWhere('email', 'LIKE', '%'.$text.'%')
                                           ->get();

        return \View::make('mentors')->with('result', $result)->with('text', $text);
    }

    public function waitlistSearch()
    {
        $text = $_POST['text'];
        $date = date("Y");


        \Session::put('current_search', $text);

        $result = \DB::table('participant')->where('waitlist', 1)
                                           ->where('year', $date)
                                           ->where(function($query)
                                           {
                                              $text = \SESSION::get('current_search');
                                              $text_array = explode(" ", $text);
                                              $text2;
                                              if(preg_match("/[a-zA-Z]*( [a-zA-Z]*)?/", $text) && count($text_array) < 2){
                                                $text2 = $text;
                                              }else{
                                                $text = $text_array[0];
                                                $text2 = $text_array[1];
                                              }

                                              $query->where('First name', 'LIKE', '%'.$text.'%')
                                                    ->orWhere('Family name', 'LIKE', '%'.$text2.'%')
                                                    ->orWhere('email', 'LIKE', '%'.$text.'%');
                                           })
                                           ->get();

        // to persist search result

        return \View::make('waitlist')->with('result', $result)->with('text', $text);
    }

    public function showParticipant($pid) 
    {
        // To be used in participant.blade.php
        $jid = \DB::table('junior')->where('jid', $pid)->pluck('jid');
        $sid = \DB::table('senior')->where('sid', $pid)->pluck('sid');
        $mid = \DB::table('mentor')->where('mid', $pid)->pluck('mid');

        $id_array = array($jid, $sid, $mid);

        // Gets all mentor senior and junior students possible data 
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid',$pid)->get();
        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        //json parse the parameter data (extra column in parameter table)
        $extra_decoded = json_decode($json_extra, true);
        $participant_result = array_merge($junior_result, $senior_result, $mentor_result);

        return \View::make('participant')->with('participant_result', $participant_result)
                                         ->with('json_extra', $json_extra)
                                         ->with('id_array', $id_array);
    }

    public function editParticipant(EditParticipantRequest $request, $pid)
    {
        // UPDATE COLUMNS IN PARTICIPANT TABLE 
        \DB::table('participant')->where('pid', $pid)
                                 ->update(['First name'         => $request['firstname'],
                                           'Family name'        => $request['familyname'],
                                           'email'              => $request['email'],
                                           'gender'             => $request['gender'],
                                           'birth year'         => $request['birthyear'],
                                           'phone'              => $request['phone'],
                                           'phone alt'          => $request['phonealt'],
                                           'kickoff'            => $request['kickoff'],
                                           'genderpref'         => $request['genderpref'],
                                           'past participation' => $request['pastparticipation'],
                                           'interest'           => $request['interest']
                                           ]);

        // To be used in participant.blade.php
        $jid = \DB::table('junior')->where('jid', $pid)->pluck('jid');
        $sid = \DB::table('senior')->where('sid', $pid)->pluck('sid');
        $mid = \DB::table('mentor')->where('mid', $pid)->pluck('mid');

        $id_array = array($jid, $sid, $mid);

        // UPDATE PARTICIPANT IF JUNIOR STUDENT 
        if ($jid == $pid) 
        {
            \DB::table('junior')->where('jid', $pid)
                                ->update(['studentNum' => $request['studentnum'],
                                          'yearStand' => $request['yearstanding'],
                                          'programOfStudy' => $request['program'],
                                          'courses' => $request['courses'],
                                          'csid' => $request['csid'],
                                          'coop' => $request['coop']
                                          ]);
        }
        // UPDATE PARTICIPANT IF SENIOR STUDENT 
        else if ($sid == $pid)
        {
            \DB::table('mentor')->where('sid', $pid)
                                ->update(['studentNum' => $request['studentnum'],
                                          'yearStand' => $request['yearstanding'],
                                          'programOfStudy' => $request['program'],
                                          'courses' => $request['courses'],
                                          'csid' => $request['csid'],
                                          'coop' => $request['coop']
                                          ]);
        }
        // UPDATE PARTICIPANT IF MENTOR
        else
        {
            \DB::table('mentor')->where('mid', $pid)
                                ->update(['yearofcs' => $request['yearofcs'],
                                          'job' => $request['job'],
                                          'edulvl' => $request['edulvl']
                                          ]);
        }
        
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



        // Gets all mentor senior and junior students possible data
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid', $pid)->get();

        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        $participant_result = array_merge($junior_result, $senior_result, $mentor_result);

        return \View::make('participant')->with('participant_result', $participant_result)
                                         ->with('json_extra', $json_extra)
                                         ->with('id_array', $id_array);
    }

    public function downloadcsv()
    {
        $range = \DB::table('participant')->select('year')->groupBy('year')->get();
//        return view('downloadcsv');
        $year = 2014;
        if (isset($_POST['year_csv'])) {
            $year = $_POST['year_csv'];
        }
        return \View::make('downloadcsv')->with('year', $year)->with('range',$range);
    }

    function recursiveRemoveDirectoryFiles($directory)
    {
        foreach(glob("{$directory}/*") as $file)
        {
            if(is_dir($file)) {
                recursiveRemoveDirectoryFiles($file);
            } else {
                unlink($file);
            }
        }
    }

    public function viewPastReport(){
      
      $year = $_POST['year'];
      $pid = $_POST['pid'];

      $result = \DB::table('report')->where('report.year', '=', $year)
                                    ->where('report.mentor', '=', $pid)
                                    ->orWhere('report.senior', '=', $pid)
                                    ->orWhere('report.junior', '=', $pid)
                                    ->get();
      //$result = $result[0];

      if(empty($result)){
        return "no report found for this participant in year ".$year. ".";
      }else{
        $result = $result[0];
      }

      // var_dump($result);
      // print($result['mentor']);
      // print($result['senior']);
      // print($result['junior']); 

      $mentor = \DB::table('participant')->where('participant.pid', '=', $result['mentor'])
                                         ->get(); 
      $mentor = $mentor[0];
      // var_dump($mentor);

      $senior = \DB::table('participant')->where('participant.pid', '=', $result['senior'])
                                         ->get();                              
      $senior = $senior[0];
      //var_dump($senior);


      $junior = \DB::table('participant')->where('participant.pid', '=', $result['junior'])
                                         ->get();
      $junior = $junior[0];
      // var_dump($junior);

      $echoline = "For year ".$result["year"]." the requested match's mentor is ".$mentor["First name"]." ".$mentor["Family name"]." with email address ".$mentor["email"].". Senior student is ".$senior["First name"]." ".$senior["Family name"]." with email address ".$senior["email"].". Junior student is ".$junior["First name"]." ".$junior["Family name"]." with email address ".$junior["email"].".";
    
      echo $echoline;

    }

    public function downloadEmailZip()
    {

        $year = $_POST['year_csv'];

        // Clean up / Create Files
        $download_dir = "downloadEmails";
        if (is_dir($download_dir)) {
            $this->recursiveRemoveDirectoryFiles($download_dir);
        } else {
            mkdir($download_dir);
        }

        // TODO: Delete any possible download zip file from previous downloads
        if (file_exists("downloadEmails.zip")) {
            unlink("downloadEmails.zip");
        }

        // In folder put each format of the lists Michelle wants as CSV
        // Assumed that every list besides WAITING LIST is to hold ONLY PEOPLE NOT ON WAITING LIST

        // FORMAT: MENTORS ONLY
        // Select * FROM participant WHERE year = $year AND waitlist = 0
        // Join on pid = mid
        // Grab the name + emails from the result
        $mentor_result = \DB::table('participant')
            ->where('participant.year','=', $year)
            ->where('participant.waitlist','=','0')
            ->join('mentor', 'participant.pid', '=', 'mentor.mid')
            ->select(\DB::raw('`First name` AS `First name`,
                                `Family name` AS `Family name`,
                                email AS email'))
            ->get();
        $mentor_file_name = "downloadEmails/mentorEmails" . $year . ".txt";
        $mentor_file = fopen($mentor_file_name, "a");
        fwrite($mentor_file, "First name, Last name, Email\r\n");
        foreach($mentor_result as $single_mentor) {
            $single_mentor_values = array_values($single_mentor);
            foreach($single_mentor_values as $single_mentor_value) {
                fwrite($mentor_file, "\"" . $single_mentor_value . "\"" . ",");
            }
            fwrite($mentor_file, "\r\n");
        }
        fclose($mentor_file);


        // FORMAT: JUNIOR STUDENTS ONLY
        // Select from junior where year = $year AND waitlist = 0
        // Join on pid = jid
        // Grab the name + emails from the result
        $junior_result = \DB::table('participant')
            ->where('participant.year','=', $year)
            ->where('participant.waitlist','=','0')
            ->join('junior', 'participant.pid', '=', 'junior.jid')
            ->select(\DB::raw('`First name` AS `First name`,
                                `Family name` AS `Family name`,
                                email AS email'))
            ->get();
        $junior_file_name = "downloadEmails/juniorEmails" . $year . ".txt";
        $junior_file = fopen($junior_file_name, "a");
        fwrite($junior_file, "First name, Last name, Email\r\n");
        foreach($junior_result as $single_junior) {
            $single_junior_values = array_values($single_junior);
            foreach($single_junior_values as $single_junior_value) {
                fwrite($junior_file, "\"" . $single_junior_value . "\"" . ",");
            }
            fwrite($junior_file, "\r\n");
        }
        fclose($junior_file);

        // FORMAT: SENIOR STUDENTS ONLY
        // Select from senior where year = $year AND waitlist = 0
        // Join on pid = sid
        // Grab the name + emails from the result
        $senior_result = \DB::table('participant')
            ->where('participant.year','=', $year)
            ->where('participant.waitlist','=','0')
            ->join('senior', 'participant.pid', '=', 'senior.sid')
            ->select(\DB::raw('`First name` AS `First name`,
                                `Family name` AS `Family name`,
                                email AS email'))
            ->get();
        $senior_file_name = "downloadEmails/seniorEmails" . $year . ".txt";
        $senior_file = fopen($senior_file_name, "a");
        fwrite($senior_file, "First name, Last name, Email\r\n");
        foreach($senior_result as $single_senior) {
            $single_senior_values = array_values($single_senior);
            foreach($single_senior_values as $single_senior_value) {
                fwrite($senior_file, "\"" . $single_senior_value . "\"" . ",");
            }
            fwrite($senior_file, "\r\n");
        }
        fclose($senior_file);

        // FORMAT: WAITING LIST PERSONS ONLY (ALL)
        // Select from senior where year = $year AND waitlist = 1
        // Join on pid = sid
        // Grab the name + emails from the result
        $waitlist_junior_result = \DB::table('participant')
            ->where('participant.year','=', $year)
            ->where('participant.waitlist','=','1')
            ->join('junior', 'participant.pid', '=', 'junior.jid')
            ->select(\DB::raw('`First name` AS `First name`,
                                `Family name` AS `Family name`,
                                email AS email'))
            ->get();
        $waitlist_senior_result = \DB::table('participant')
            ->where('participant.year','=', $year)
            ->where('participant.waitlist','=','1')
            ->join('senior', 'participant.pid', '=', 'senior.sid')
            ->select(\DB::raw('`First name` AS `First name`,
                                `Family name` AS `Family name`,
                                email AS email'))
            ->get();
        $waitlist_mentor_result = \DB::table('participant')
            ->where('participant.year','=', $year)
            ->where('participant.waitlist','=','1')
            ->join('mentor', 'participant.pid', '=', 'mentor.mid')
            ->select(\DB::raw('`First name` AS `First name`,
                                `Family name` AS `Family name`,
                                email AS email'))
            ->get();
        $waitlisted_result = array_merge($waitlist_junior_result, $waitlist_senior_result, $waitlist_mentor_result);
        $waitlisted_file_name = "downloadEmails/waitlistEmails" . $year . ".txt";
        $waitlisted_file = fopen($waitlisted_file_name, "a");
        fwrite($waitlisted_file, "First name, Last name, Email\r\n");
        foreach($waitlisted_result as $single_waitlisted) {
            $single_waitlisted_values = array_values($single_waitlisted);
            foreach($single_waitlisted_values as $single_waitlisted_value) {
                fwrite($waitlisted_file, "\"" . $single_waitlisted_value . "\"" . ",");
            }
            fwrite($waitlisted_file, "\r\n");
        }
        fclose($waitlisted_file);

        // FORMAT: JUNIOR AND SENIOR STUDENTS
        // JOIN name + email results from JUNIOR ONLY and SENIOR ONLY
        $junior_senior_result = array_merge($junior_result, $senior_result);
        $junior_senior_file_name = "downloadEmails/juniorSeniorEmails" . $year . ".txt";
        $junior_senior_file = fopen($junior_senior_file_name, "a");
        fwrite($junior_senior_file, "First name, Last name, Email\r\n");
        foreach($junior_senior_result as $single_junior_senior) {
            $single_junior_senior_values = array_values($single_junior_senior);
            foreach($single_junior_senior_values as $single_junior_senior_value) {
                fwrite($junior_senior_file, "\"" . $single_junior_senior_value . "\"" . ",");
            }
            fwrite($junior_senior_file, "\r\n");
        }
        fclose($junior_senior_file);

        // FORMAT: JUNIOR STUDENTS, SENIOR STUDENTS, AND MENTORS
        // JOIN name + email results from JUNIOR ONLY, SENIOR ONLY, AND MENTOR ONLY
        $junior_senior_mentor_result = array_merge($junior_result, $senior_result, $mentor_result);
        $junior_senior_mentor_file_name = "downloadEmails/juniorSeniorMentorEmails" . $year . ".txt";
        $junior_senior_mentor_file = fopen($junior_senior_mentor_file_name, "a");
        fwrite($junior_senior_mentor_file, "First name, Last name, Email\r\n");
        foreach($junior_senior_mentor_result as $single_junior_senior_mentor) {
            $single_junior_senior_mentor_values = array_values($single_junior_senior_mentor);
            foreach($single_junior_senior_mentor_values as $single_junior_senior_mentor_value) {
                fwrite($junior_senior_mentor_file, "\"" . $single_junior_senior_mentor_value . "\"" . ",");
            }
            fwrite($junior_senior_mentor_file, "\r\n");
        }
        fclose($junior_senior_mentor_file);

        // ZIP THE FOLDER
        $download_file_zip = 'downloadEmails.zip';
        $files = glob('downloadEmails/*');
        \Zipper::make($download_file_zip)->add($files);
        \Zipper::close();

        //Send file
        $headers = array(
            'Content-Type: application/zip'
        );

        return response()->download("downloadEmails.zip", "TMMSParticipantEmails".$year.".zip", $headers);


        // RETURN DOWNLOAD RESPONSE
    }


    // Check if string is JSON
    function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function downloadCSVfile()
    {

//        // TODO: Update this function to be able to specify the CSV that we want.

        $year = $_POST['year_csv'];

        $junior_pap = \DB::table('participant')
            ->where('participant.year','=', $year)->join('junior', 'participant.pid', '=', 'junior.jid')
            ->leftjoin('parameter', function($join) use ($year)
            {
                $join->on('participant.pid', '=', 'parameter.pid')
                    ->where('parameter.year', '=', $year);
            })->select(\DB::raw('participant.pid AS pid,
                        `First name` AS `First name`,
                        `Family name` AS `Family name`,
                        gender AS gender,
                        kickoff AS kickoff,
                        email AS email,
                        phone AS phone,
                        `phone alt` AS `phone alt`,
                        `birth year` AS `birth year`,
                        genderpref AS genderpref,
                        `past participation` AS `past participation`,
                        waitlist AS waitlist,
                        participant.year AS year,
                        interest AS interest,
                        jid AS jid,
                        studentNum AS studentNum,
                        yearStand AS yearStand,
                        programOfStudy AS programOfStudy,
                        courses AS courses,
                        csid AS csid,
                        coop AS coop,
                        extra AS extra'))
            ->get();
        $senior_pap = \DB::table('participant')
            ->where('participant.year','=', $year)->join('senior', 'participant.pid', '=', 'senior.sid')
            ->leftjoin('parameter', function($join) use ($year)
            {
                $join->on('participant.pid', '=', 'parameter.pid')
                    ->where('parameter.year', '=', $year);
            })->select(\DB::raw('participant.pid AS pid,
                        `First name` AS `First name`,
                        `Family name` AS `Family name`,
                        gender AS gender,
                        kickoff AS kickoff,
                        email AS email,
                        phone AS phone,
                        `phone alt` AS `phone alt`,
                        `birth year` AS `birth year`,
                        genderpref AS genderpref,
                        `past participation` AS `past participation`,
                        waitlist AS waitlist,
                        participant.year AS year,
                        interest AS interest,
                        sid AS sid,
                        studentNum AS studentNum,
                        yearStand AS yearStand,
                        programOfStudy AS programOfStudy,
                        courses AS courses,
                        csid AS csid,
                        coop AS coop,
                        extra AS extra'))
            ->get();
        $mentor_pap = \DB::table('participant')
            ->where('participant.year','=', $year)->join('mentor', 'participant.pid', '=', 'mentor.mid')
            ->leftjoin('parameter', function($join) use ($year)
            {
                $join->on('participant.pid', '=', 'parameter.pid')
                    ->where('parameter.year', '=', $year);
            })->select(\DB::raw('participant.pid AS pid,
                        `First name` AS `First name`,
                        `Family name` AS `Family name`,
                        gender AS gender,
                        kickoff AS kickoff,
                        email AS email,
                        phone AS phone,
                        `phone alt` AS `phone alt`,
                        `birth year` AS `birth year`,
                        genderpref AS genderpref,
                        `past participation` AS `past participation`,
                        waitlist AS waitlist,
                        participant.year AS year,
                        interest AS interest,
                        mid AS mid,
                        job AS job,
                        yearofcs AS yearofcs,
                        edulvl AS edulvl,
                        extra AS extra'))
            ->get();

        // TODO: Clean the local directory holding download csvs

        $download_dir = "downloadFiles";
        if (is_dir($download_dir)) {
            $this->recursiveRemoveDirectoryFiles($download_dir);
        } else {
            mkdir($download_dir);
        }

        // TODO: Delete any possible download zip file from previous downloads
        if (file_exists("downloadFiles.zip")) {
            unlink("downloadFiles.zip");
        }


        //*****************************************************************

        // Create CSV/TXT file local FOR JUNIOR
        $junior_file_name = "downloadFiles/juniorCSV" . $year . ".txt";
        $junior_file = fopen($junior_file_name, "a");

        $single_pap = $junior_pap[0];
        $key_array = array_keys($single_pap);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($junior_file, $one_key . ",");
        }
        // Write endline
        fwrite($junior_file, "\r\n");

        // Write values for each entry
        foreach($junior_pap as $single_junior) {
            // Get values for single_junior:
            $single_junior_values = array_values($single_junior);
            // Write each value to the junior file:
            foreach($single_junior_values as $single_junior_value) {
                $single_junior_value = str_replace('"', '`', $single_junior_value);
                fwrite($junior_file, "\"" . $single_junior_value . "\"" . ",");
            }
            // Write endline
            fwrite($junior_file, "\r\n");
        }

        //Close file
        fclose($junior_file);

        //*****************************************************************

        // Create CSV/TXT file local FOR SENIOR
        $senior_file_name = "downloadFiles/seniorCSV" . $year . ".txt";
        $senior_file = fopen($senior_file_name, "a");

        $single_pap = $senior_pap[0];
        $key_array = array_keys($single_pap);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($senior_file, $one_key . ",");
        }
        // Write endline
        fwrite($senior_file, "\r\n");

        // Write values for each entry
        foreach($senior_pap as $single_senior) {
            // Get values for single_junior:
            $single_senior_values = array_values($single_senior);
            // Write each value to the junior file:
            foreach($single_senior_values as $single_senior_value) {
                $single_senior_value = str_replace('"', '`', $single_senior_value);
                fwrite($senior_file, "\"" . $single_senior_value . "\"" . ",");
            }
            // Write endline
            fwrite($senior_file, "\r\n");
        }

        //Close file
        fclose($senior_file);

        //*****************************************************************

        // Create CSV/TXT file local FOR MENTOR
        $mentor_file_name = "downloadFiles/mentorCSV" . $year . ".txt";
        $mentor_file = fopen($mentor_file_name, "a");

        $single_pap = $mentor_pap[0];
        $key_array = array_keys($single_pap);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($mentor_file, $one_key . ",");
        }
        // Write endline
        fwrite($mentor_file, "\r\n");

        // Write values for each entry
        foreach($mentor_pap as $single_mentor) {
            // Get values for single_junior:
            $single_mentor_values = array_values($single_mentor);
            // Write each value to the junior file:
            foreach($single_mentor_values as $single_mentor_value) {
                $single_mentor_value = str_replace('"', '`', $single_mentor_value);
                fwrite($mentor_file, "\"" . $single_mentor_value . "\"" . ",");
            }
            // Write endline
            fwrite($mentor_file, "\r\n");
        }

        //Close file
        fclose($mentor_file);

        //*****************************************************************

        // Create CSV/TXT file local FOR REPORTS
        $reports_file_name = "downloadFiles/reportsCSV" . $year. ".txt";
        $reports_file = fopen($reports_file_name, "a");

        $reports = \DB::table('report')
            ->where('report.year','=', $year)
            ->get();

        $single_report = $reports[0];
        $key_array = array_keys($single_report);

        // Write each heading to local file
        foreach($key_array as $one_key) {
            fwrite($reports_file, $one_key . ",");
        }

        // Write endline
        fwrite($reports_file, "\r\n");


        // Write values for each entry
        foreach($reports as $one_report) {
            // Get values for single_junior:
            $one_report_values = array_values($one_report);
            // Write each value to the junior file:
            foreach($one_report_values as $one_report_value) {
                fwrite($reports_file, "\"" . $one_report_value . "\"" . ",");
            }
            // Write endline
            fwrite($reports_file, "\r\n");
        }

        //Close file
        fclose($reports_file);

        //*****************************************************************

        //Zip up all files in downloadFiles directory
        $download_file_zip = 'downloadFiles.zip';
        $files = glob('downloadFiles/*');
        \Zipper::make($download_file_zip)->add($files);
        \Zipper::close();

        //Send file
        $headers = array(
            'Content-Type: application/zip'
        );

        return response()->download("downloadFiles.zip", "TMMSParticipant".$year.".zip", $headers);
    }

    public function deleteYear()
    {
        $year = $_POST['year_csv'];
        // Update participant where year = $_POST['year_csv']
        // Set year to 0
        \DB::table('participant')
            ->where('year', $year)
            ->update(['year' => 0]);

        // Update parameter where year = $_POST['year_csv']
        // Set year to 0
        \DB::table('parameter')
            ->where('year', $year)
            ->update(['year' => 0]);

        // Don't touch Junior/Senior/Mentor (No year data)
        // Don't touch Report

        // Return view success?

        return \View::make('success')->with('year', $year)
            ->with('message',"Successfully deleted year data");
    }

}
