<?php namespace App\Http\Controllers;

class testEmailController extends Controller {

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
//
//    /**
//     * Create a new controller instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }

    public function index()
    {
       // return view('testemail');

        $result = \DB::table('users')->select('name as name')->addSelect('email as email')->get();
        // Return view with log array
        return \View::make('testemail')->with('result',$result);
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function downloadEmails()
    {
        // Read database for values. Current only users and email
        $result = \DB::table('users')->select('name as name')->addSelect('email as email')->get();

        // Create CSV/TXT file local
        $file_name = "contactsFile" . time() . ".txt";
        $myfile = fopen($file_name, "a");

        // Write headings to local file
        fwrite($myfile, "Name, Email, \r\n");

        //Iterate result and write to file:
        foreach($result as $singleResult) {
            fwrite($myfile, $singleResult['name'] . "," . $singleResult['email'] . ",\r\n");
        }

        //Close file
        fclose($myfile);

        //Send file
        $headers = array(
            'Content-Type: text/plain'
        );

        // Problem: timestamped list still exists. Implement some cache clearing system?
        return response()->download($file_name, "contactsFile.txt", $headers);

    }

}
