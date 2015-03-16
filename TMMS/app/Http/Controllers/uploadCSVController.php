<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class uploadCSVController extends Controller {

	public function index()
	{	
		$preview_header = array();
		$preview_data = array();
		return view('uploadcsv',compact('preview_header','preview_data'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function upload()
	{
		$target_dir = "Uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOK = 1;

		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], SITE_ROOT.'/../storage/app/1.csv')){
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		}else{
			echo "Sorry, an error occur while uploading, please try again.";
		}

		$config = new LexerConfig();
		$lexer = new Lexer($config);
		$interpreter = new Interpreter();
		$result = array();
		$linecount = 1;
		$interpreter->addObserver(function(array $columns) use (&$result) {
			$result[] = $columns;
		});
		$lexer->parse(SITE_ROOT.'/../storage/app/1.csv', $interpreter);
		// parses the uploaded CSV at where is putted in to array
		// result[0] are the headers 
		// result[1...n] are the participants 
		$preview_data = array();
		foreach ($result as $key => $value) {
			if($key == 0){
				$preview_header = $value;
			}else{
				$preview_data[] = $value;
			}
		}
		
		return view('uploadcsv',compact('preview_header','preview_data'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
