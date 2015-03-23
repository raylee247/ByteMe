<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class uploadCSVController extends Controller {

	public function __construct()
    {
        $this->middleware('auth');
    }

	public function index()
	{	
		$preview_header = array();
		$preview_data = array();
		return view('uploadcsv',compact('preview_header','preview_data'));
	}
	/**
	 * preview the csv being uploaded 
	 *
	 * @return view 
	 */
	public function preview()
	{
		$target_dir = "Uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOK = 1;

		if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], SITE_ROOT.'/../storage/app/1.csv')){
			$test = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		}else{
			$test = "Sorry, an error occur while uploading, please try again.";
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
		
		return view('uploadcsv',compact('preview_header','preview_data', 'test'));
	}

	public function upload(){
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
		$data = array();
		foreach ($result as $key => $value) {
			if($key == 0){
				$header = $value;
			}else{
				$data[] = $value;
			}
		}

		// get "who" (mentor or student) is this CSV for
		$participantType = "mentor";
		// or 
		$participantType = "student";

		// general prarm for a participant. 
		$index_firstName = array_search("Given name",$header);
		$index_lastName = array_search("Family name", $header);
		$index_gender = array_search("Gender (please specify)", haystack);
		
		// regex for date , or however the kick off date will be represented in our csv
		$index_Kickoff = array_search("", $header);
		
		$index_email = array_search("E-mail", $header);
		$index_phone = array_search("Phone", $header);
		$index_phone_alt = array_search("Phone (alternate)", $header);
		$index_birth = array_search("Birth year ", $header);
		//$index_genderPref = array_search("Preference of student mentee gender", $header);
		
		//what is this?
		$index_pastParticipation = array_search("???", $header);


		if ($participantType == "mentor"){
			// get param for mentor 
			// job title, do i include the company ?

			$index_genderPref = array_search("Preference of student mentee gender", $header);
			$index_job = array_search("Current job title", $header);
			$index_yearofCS = array_search("Years of CS-related work experience", $header);
			$index_eduLv = array_search("Highest level of education", $header);
			$index_fieldOfInterest = array_search("CS areas of interest", $header);

			// construct SQL statement 
			foreach ($data as $key) {				
			$SQL_participant  = "insert into innodb.participant values ( 
								''," +   
								$data[$key][$index_firstName]+ "," +
								$data[$key][$index_lastName]+ "," +
								$data[$key][$index_gender]+ "," +
								$data[$key][$index_Kickoff]+ "," +
								$data[$key][$index_email]+ "," +
								$data[$key][$index_phone]+ "," +
								$data[$key][$index_phone_alt]+ "," +
								$data[$key][$index_birth]+ "," +
								$data[$key][$index_genderPref]+ "," +
								"'','',''"+ ");";
			print($SQL_participant);
			$SQL_mentor = "insert into innodb.mentor values( ''," +
						   $data[$key][$index_job] +","+
						   $data[$key][$index_yearofCS] +","+
						   $data[$key][$index_eduLv] +","+
						   $data[$key][$index_fieldOfInterest] + ");";
			print ($SQL_mentor);
			$SQL_Parameter = "insert into innodb.parameter values ('',"+
							// current year 
							// rest of the data 
							"";
			print($SQL_Parameter);




			}
		}else{
			// else get student param, and classify senior as year > 2 for old csv. for out CSV will have a category 
			$index_genderPref = array_search("Mentor gender preference", $header);
			$index_studentNumber = array_search("Student number", $header);
			$index_yearStnd = array_search("Year of study ", $header);
			$index_programOfStudy = array_search("Program of study", $header);
			// WTF no ID id in CSV TROLOLOL
			// $index_csid 
			// with senior flag base on courses 

			foreach ($data as $key) {				
			$SQL_participant  = "insert into innodb.participant values ( 
								''," +   
								$data[$key][$index_firstName]+ "," +
								$data[$key][$index_lastName]+ "," +
								$data[$key][$index_gender]+ "," +
								$data[$key][$index_Kickoff]+ "," +
								$data[$key][$index_email]+ "," +
								$data[$key][$index_phone]+ "," +
								$data[$key][$index_phone_alt]+ "," +
								$data[$key][$index_birth]+ "," +
								$data[$key][$index_genderPref]+ "," +
								"'','',''"+ ");";
			print($SQL_participant);
			if ($senior){
				$SQL_student = "insert into innodb.senior values( ''," +
						   $data[$key][$index_job] +","+
						   $data[$key][$index_yearofCS] +","+
						   $data[$key][$index_eduLv] +","+
						   $data[$key][$index_fieldOfInterest] + ");";
				print ($SQL_mentor);
			}else{
				$SQL_student = "insert into innodb.junior values( ''," +
						   $data[$key][$index_job] +","+
						   $data[$key][$index_yearofCS] +","+
						   $data[$key][$index_eduLv] +","+
						   $data[$key][$index_fieldOfInterest] + ");";
				print ($SQL_mentor);
			}

			$SQL_Parameter = "insert into innodb.parameter values ('',"+
							// current year 
							// rest of the data 
							"";
			print($SQL_Parameter);
		}




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
