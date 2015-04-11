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

    /*
    * Function: get the saved matches
    * 
    * Paramters: none
    *
    * Return: match result view
    */

    public function matchresultindex()
    {

        return view('matchresult');
    }

    /*
    * Function: get the saved matches
    * 
    * Paramters: none
    *
    * Return: return array of values in weighting table
    */

    public function savedmatchesindex()
    {

        $Response =  \DB::table('weighting')->get();

        return view('savedmatches', compact('Response'));
    }

    /*
    * Function: shows the current match
    * 
    * Paramters: none
    *
    * Return: array and messages for the view if there exists any relevant data in the DB
    */
    public function currentmatchindex()
    {
        $year = date("Y");
        $message = "fail";
        $rawApp = \DB::table("report")->where("year",$year)->get();
        if (count($rawApp)){
            $message = "success";
        }
        
        $participants = array();
        $response_participant= \DB::table('participant')->where ('year', '=', date("Y"))
                                                        ->get();
        

        foreach ($response_participant as $key => $value) {
            $participants[$value['pid']] = $value;
        }
        // var_dump($participants);
        $names = array();
        foreach ($rawApp as $key => $match) {
            if (array_key_exists($match['mentor'], $participants)){
                $names[$match['mentor']] = $participants[$match['mentor']]['First name'] . " " . 
                                           $participants[$match['mentor']]['Family name'];
            }
            if(array_key_exists($match['senior'], $participants)){
                $names[$match['senior']] = $participants[$match['senior']]['First name'] . " " . 
                                           $participants[$match['senior']]['Family name'];
            }
            if(array_key_exists($match['junior'], $participants)){
                $names[$match['junior']] = $participants[$match['junior']]['First name'] . " " . 
                                           $participants[$match['junior']]['Family name'];
            }
            if(!isset($names[$match['mentor']])){
                $names[$match['mentor']] = "First Last mentor";
            }
            if(!isset($names[$match['senior']])){
                $names[$match['senior']] = "First Last senior";
            }
            if(!isset($names[$match['junior']])){
                $names[$match['junior']] = "First Last junior";
            }
            
    
        }

        // var_dump($names);
        $weighting= \DB::table('weighting')->where('setAsFinal', '=', 1)->first();

        return view('currentmatch',compact('message','rawApp','names', 'weighting'));
    }

    /*
    * Function: set kickoff night page content
    * Grab all saved kickoff matching groups from kickoffgroup tablr and kickoffresult table then put them into a response
    * array, return it to the new view
    *
    * Return: response array for the page to display the content
    */
    public function kickoffindex()
    {
        // $year = date("Y");
        // $message = "fail";
        $all_groups = \DB::table('kickoffgroup')->join('kickoffresult', 'kickoffresult.kid', '=', 'kickoffgroup.kgid')->get();

        $response = array();
        $unique_dates = array();

        foreach($all_groups as $value){
            array_push($unique_dates, $value['date']);
        }

        $unique_dates = array_unique($unique_dates);

        $i = 0;
        foreach ($unique_dates as $value) {
            array_push($response, array());
            $response[$value] = $response[$i];
            unset($response[$i]);
            $i++;
        }

        foreach ($unique_dates as $date) {
            $groups;
            foreach($all_groups as $value) {
                $groups = array();
                if(strcmp($value['date'], $date) == 0){
                    $group_array = explode(",", $value['grouping']);
                    array_push($response[$date], $group_array);
                }
            }
        }

        // $rawApp = \DB::table("report")->where("year",$year)->get();
        // if (count($rawApp)){
        //     $message = "success";
        // }

        // var_dump($groups);

        return view('kickoffmatches')->with('kickoffmatchings', $response);
    }
// POST request to db to save match name 
    public function savedmatchname()
    {
// TODO: SAVE NAME TO DB
        return view('savedmatches');
    }

    // POST request to db to save maximum participants for kickoff 
    /*
    * Function: Generate and save kickoff matchings
    * Get all paritcipants from participant table with the trios from the selected matchings set then format the values
    * into a new array then return to view
    *
    * Return: return the correctly formatted content data to the view
    */
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
                     'year' => date("Y"),
                    ]
                );
        }


        \DB::table('weighting')
                ->where('setAsFinal', 1)
                ->update(array('setAsFinal' => 0));

        \DB::table('weighting')
                ->where('wid', $_POST['target_wid'])
                ->update(array('setAsFinal' => 1));
        
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
