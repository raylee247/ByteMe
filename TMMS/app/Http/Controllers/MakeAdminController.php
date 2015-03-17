<?php namespace App\Http\Controllers;

use Request; 
use App\User;

class MakeAdminController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index()
    {
        return view('makeadmin');
    }

    // store admin to database 
    public function store()
    {
        $data = Request::all();

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('makeadmin'); 
    }
}
