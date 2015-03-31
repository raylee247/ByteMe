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


        return view('currentmatch',compact('message','rawApp'));
    }

    public function kickoffindex()
    {
        $year = date("Y");
        $message = "fail";
        $kickoffresult = \DB::table('kickoffresult')->get();
        $kickoffgroup = \DB::table('kickoffgroup')->get();

        $response = array();
        $date = array();
        //grab the date with group
        $group_with_date = array();



        foreach($all_groups as $value){
            array_push($group_with_date, $value['date'].":".$value['grouping']);
            array_push($response, $value['kid']);
            array_push($date, $value['date']);
        }

        $response = array_unique($response);
        $date = array_unique($date);
        $date = array_values($date);

        $index = 0;

        foreach ($response as $key => $value) {
            $response[$date[$index]] = $response[$key];
            unset($response[$key]);
            $response[$date[$index]] = array();
        }


        $groups;

        foreach($all_groups as $value){
            $groups = array();
            $groups = explode(",", $value['grouping']);
            //var_dump($groups);
            var_dump($response[$value['date']]);
            array_push($response[$value['date']], $groups);
        }



        $rawApp = \DB::table("report")->where("year",$year)->get();
        if (count($rawApp)){
            $message = "success";
        }

        var_dump($response);

        return view('kickoffmatches')->with('kickoffmatchings', $response);
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
        $check = \DB::table('report')->where ('year', '=', date("Y"))->get();
        if (count($check) > 0){
           \DB::table('report')->where('year', '=', date("Y"))->delete();
        }

        
        $selected_result = \DB::table('trioMatching')->where ('wid', '=', $_POST['target_wid'])
                                                     ->get();

        foreach ($selected_result as $index => $match) {
            \DB::table('report')->insert(
                    ['mentor' => $match['mentor'],
                     'senior' => $match['senior'],
                     'junior' => $match['junior'],
                     'satisfaction' => $match['satisfaction'],
                     'year' => date("Y")
                    ]
                );
        }
        
// TODO: SAVE NUMBER TO DB
        $mentor_per_group = $_POST["nummentors"];
        $participants_per_night = $_POST["maxparticipants"];
        $matcher = new KickOffMatch($participants_per_night, $mentor_per_group);
        $response = $matcher->generate();

        $check = \DB::table('kickoffresult')->get();
        if (count($check) > 0){
           \DB::table('kickoffresult')->delete();
        }

        $check = \DB::table('kickoffgroup')->get();
        if (count($check) > 0){
           \DB::table('kickoffgroup')->delete();
        }

        foreach($response as $date => $groups){
            \DB::table('kickoffresult')->insert(
                ['date' => $date]
                );
        }

        foreach($response as $date => $groups){
            $id = \DB::table('kickoffresult')->where('date', '=', $date)->get();
            $id = $id[0];
            // var_dump($id);
            foreach ($groups as $value) {
                \DB::table('kickoffgroup')->insert(
                ['kgid' => $id['kid'], 'grouping' => implode(",", $value)]
                );
            }
        }

        // var_dump($response);

        return view('kickoffmatches')->with('kickoffmatchings', $response);
    }

}
