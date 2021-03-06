<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class profileController extends Controller {


    /*

       Function: downloadParticipant

       Downloads the participant profile 

       Parameters:
       none

       Returns:
       The downloaded participant text file 

    */
    public function downloadParticipant()
    {
        $pid = $_POST['download_pid'];

        // Query the 3 tables with PID 
        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get();
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid', $pid)->get();

        $participant_result = array_merge($junior_result, $senior_result, $mentor_result);

        // Query parameter table with the correct PID 
        $json_extra = \DB::table('participant')->join('parameter', 'participant.pid', '=', 'parameter.pid')
                                               ->where('parameter.pid', $pid)->pluck('extra');

        // Decode JSON object
        $extra = json_decode($json_extra, true);
        $extra_keys = array_keys($extra);


        $key_array = array_keys($participant_result[0]);

        // ACTUAL FILE WRITING STARTS HERE 
        $file_name = "participant.txt";

        $handle = fopen($file_name, "w");

        foreach ($key_array as $key)
        {
            fwrite($handle, $key.": ".$participant_result[0][$key]."\r\n");
        }

        foreach ($extra_keys as $extra_key) 
        {
            fwrite($handle, $extra_key.": ".$extra[$extra_key]."\r\n");
        }

        fclose($handle);

        $headers = array(
            'Content-Type: text/plain',
        );

        return response()->download($file_name, "Participant".$participant_result[0]['First name'].$participant_result[0]['Family name'].".txt", $headers);
    }

    /*

       Function: deleteParticipant

       Remove participant from the current year's tri-mentoring program

       Parameters:
       none

       Returns:
       Redirects user back to the student or mentor search page

    */
	public function deleteParticipant()
	{
        //retrieve email to do query on the participant to remove (email cause it is shared primary key)
		    $pid = $_POST['delete_participant'];
        $year = date("Y");
        //$email = "willy504@gmail.com";
        //$year = "2014";


        \DB::table('participant')->where('year', $year)->where('pid', $pid)->update(['year' => 0]);
        \DB::table('parameter')->where('year', $year)->where('pid', $pid)->update(['year' => 0]);


        $junior_result = \DB::table('participant')->join('junior', 'participant.pid', '=', 'junior.jid')
                                                  ->where('pid', $pid)->get();   
        $senior_result = \DB::table('participant')->join('senior', 'participant.pid', '=', 'senior.sid')
                                                  ->where('pid', $pid)->get(); 
        $mentor_result = \DB::table('participant')->join('mentor', 'participant.pid', '=', 'mentor.mid')
                                                  ->where('pid', $pid)->get(); 

        $students_result = array_merge($junior_result, $senior_result);

        if (isset($students_result[0]['pid'])) {
            return redirect('students');
        }

        else {
            return redirect('mentors');
        }
	}

    /*

       Function: toWaitlistPool

       Moves the participant to waitlist from participant pool

       Parameters:
       none

       Returns:
       Redirects user back to original page

    */
	public function toWaitlistPool()
	{
        //retrieve email to do query on the participant to remove (email cause it is shared primary key)
        //$email = $_GET['email'];
        //$year = date("Y");
        $email = $_POST['participant_email_to_wl'];
        $year = date("Y");
        $rawApp = \DB::table('participant')->where('year', $year)->where('email', $email)->update(array('waitlist'=> 1));

        //check if correctly updated
        if($rawApp > 1){
            $response = "updated too many";
        }if($rawApp < 1) {
            $response = "did nothing";
        }else{
            $response = "Moved into waitlist pool";
        }

        //placeholder redirect message
         \Session::flash('flash_message', 'Successfully added participant into waitlist pool!');

        return \Redirect::back();
	}

    /*

       Function: toParticipantPool

       Moves the participant from waitlist to participant pool

       Parameters:
       none

       Returns:
       Redirects user back to original page

    */
	public function toParticipantPool()
	{
        $email = $_POST['participant_email_to_pp'];
        $year = date("Y");
        $rawApp = \DB::table('participant')->where('year', $year)->where('email', $email)->update(array('waitlist' => 0));

        //check if correctly updated
        if($rawApp > 1){
            $response = "updated too many";
        }if($rawApp < 1) {
            $response = "did nothing";
        }else{
            $response = "Moved into participant pool";
        }

        //placeholder redirect message
        \Session::flash('flash_message', 'Successfully added participant into participant pool!');

        return \Redirect::back();
    }


}
