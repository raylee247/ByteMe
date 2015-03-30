<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\KickOffMatch;

use Illuminate\Http\Request;

session_start();

class weightController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function index()
    {
        $name = "bob";
		//return view('weighting', compact('name'));
        return view('weighting', compact($name));
    }

    /**
     * Converts weights string into a array of weight parameters
     * passes into matching algorithm
     * @param $weights
     * @return Matching result
     */

    public function submitWeights()
    {
        //$_POST comes in as "para_a, para_b, para_c"
        $weight = $_POST('weights');
        $must = $_POST('musts');

        //turn it from string to array
        // weights[para_a, para_b, para_c]
        $weights[] = explode(',' , $weight);
        $musts[] = explode(',' , $must);

        //add to session
        $_SESSION['weight'] = $weights;
        $_SESSION['must'] = $musts;

    }

    public function matchresultindex()
    {

        return view('matchresult');
    }

    public function savedmatchesindex()
    {

        $Response =  \DB::table('weighting')->get();

        return view('savedmatches', compact('Response'));
    }

    public function currentmatchindex()
    {
        $year = date("Y");
        $message = "fail";
        $rawApp = \DB::table("report")->where("year",$year)->get();
        if (count($rawApp)){
            $message = "success";
        }
        return view('currentmatch')->with('message', $message);
    }

    public function kickoffindex()
    {
        $year = date("Y");
        $message = "fail";
        $rawApp = \DB::table("report")->where("year",$year)->get();
        if (count($rawApp)){
            $message = "success";
        }
        return view('kickoffmatches')->with('message', $message);
    }
// POST request to db to save match name 
    public function savedmatchname()
    {
// TODO: SAVE NAME TO DB
        return view('savedmatches');
    }

    // POST request to db to save maximum participants for kickoff 
    public function savedmaxKickoff()
    {
        // do db operation  of pushing the selcted result into result table
        $selected_result = $_POST['target_wid'];
        
// TODO: SAVE NUMBER TO DB
        $mentor_per_group = $_POST["nummentors"];
        $participants_per_night = $_POST["maxparticipants"];
        $matcher = new KickOffMatch($participants_per_night, $mentor_per_group);
        $response = $matcher->generate();

        // var_dump($response);
        return view('kickoffmatches')->with('kickoffmatchings', $response);
    }

}
