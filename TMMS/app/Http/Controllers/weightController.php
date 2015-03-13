<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $weight = $_POST('weights');
        $must = $_POST('musts');
        $weights[] = explode(',' , $weight);
        $musts[] = explode(',' , $must);

        $_SESSION['weight'] = $weights;
        $_SESSION['must'] = $musts;

    }


}
