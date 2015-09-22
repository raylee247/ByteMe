<?php namespace App\Http\Controllers;

class TestDBController extends Controller {

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
        //return view('studentapp');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function DBselect()
    {
        $result = \DB::table('users')->select('name as user_name')->addSelect('email as user_email')->get();
        if (\Auth::check()) {
            $name = \Auth::user()->name;
        } else {
            $name = 'guest';
        }
        $result_array = ['result'=>$result, 'name'=>$name];
//        $result_array = $this->DBQuery('select(DB::raw("select * from users"))');
//        $result_array = $this->DBQuery('table(\'users\')->select(\'name as user_name\')->addSelect(\'email as user_email\')->get');
//        $result_array = $this->DBQuery("table('users')->get()");
//        $result_array = $this->DBQuery();
        return \View::make('testDBselect')->with('results', $result_array);
//        return view('testDBselect')->with('load_array', array('results'=> $results, 'querylog'=> $querylog));
    }

}
