<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\MakeAdminRequest;

class MakeAdminController extends Controller {

    /*

        Function: __construct

        when looking at this page it will require that people are a guest

        Parameters:
        none

        Returns:
        none

    */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*

        Function: index

        Returns the make admin page

        Parameters:
        none

        Returns:
        none

    */
    public function index()
    {
        return view('makeadmin');
    }

    /*

        Function: store

        Takes the request and creates a new administrator in the system.

        Parameters:
        $request - string with admin credentials

        Returns:
        Success or fail message on the makeadmin view.

    */
    public function store(MakeAdminRequest $request)
    {
        //User::create($request->all());

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        \Session::flash('flash_message', 'Successfully created admin!');

        return redirect('makeadmin'); 
    }
}
