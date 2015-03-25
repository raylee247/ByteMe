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
		$this->CSVContent = $result;
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
		// var_dump($header);
		// var_dump($data);

		
		// Given : participant type 
		// 		   what is to be upload? (full db backup? matching ? or participant upload)
		// upload procedure :
		// 1. determine the version of CSV (provided version OR generated version)
		// 2. parse EVERYTHING accordingly 
		// 3. setup array with input 
		// 4. setup SQL statement with array

		// determine the version 
		if(array_search("IP Address", $header)!==false){
			//parse with old way 
			$this->parseOldCSV($_POST['category'], $header, $data); 
		}else{
			//parse with new way
		}

		return 0;
	}

	public function parseOldCSV($type,$headers,$datas){
		print($type);
		// $type is either mentors or student
		// header string require for participant 
		$participant_target_keywords = array("---", // pid
											 "Given",
											 "Family",
											 "Gender",
											 "-",
											 "mail",
											 "Phone",
											 "Phone (alternate)",
											 "Birth year",
											 "reference", // gender preference 
											 "---", // past participant
											 "---" // waitlist
											 );
		$mentor_target_keywords = array("---", // mid
										"title", // job title  
										"Years of CS", // year of CS
										"level of education", //edu lv
										"CS areas of interest" // field of interest 
										);
		$student_target_keywords = array("---",
										"Student number",// student num
										"Year of study ",// year stand 
										"Program of study",//programOfStudy
										"---",//courses
										"---",//csid 
										"Co-op status"// co op 
										);
		
		// foreach participant in data
		foreach ($datas as $person) {
			$headers_clone = $headers; 

			// construct participant value array
			$participant_values = array();
			foreach ($participant_target_keywords as $keyword) {
				// go through headers to find the index
				$value ="";
				for ($i=0; $i < count($headers_clone)-1; $i++) { 
					$header = $headers_clone[$i];
					if (strpos($header, $keyword) !== FALSE){
						if($keyword == "-"){
							// got a date 
							// get all three pref
							$temp = array();
							for ($x=0; $x <3; $x++) { 
								switch ($person[$i+$x]) {
									case 'First Choice':
										if (array_key_exists(0, $temp)){
											$temp[] = $headers_clone[$i+$x];
										}else{
											$temp[0] = $headers_clone[$i+$x];
										}
										break;
									case 'Second Choice':
										if (array_key_exists(1, $temp)){
											$temp[] = $headers_clone[$i+$x];
										}else{
											$temp[1] = $headers_clone[$i+$x];
										}
										break;
									case 'Third Choice':
										if (array_key_exists(2, $temp)){
											$temp[] = $headers_clone[$i+$x];
										}else{
											$temp[2] = $headers_clone[$i+$x];
										}
										break;
								}
							}
							$temp = $this->format_date($temp);
							$value = implode(",", $temp);
							
						}else{
							$value = $person[$i];
						}
							
						break;
					}
				}
				$participant_values[] = $value;
			}
			$participant_values[] = date("Y");
			// var_dump($participant_values);
			// print("\n===============================\n");

			if($type == "mentor"){
				// construct mentor value array
				$mentor_values = array();
				foreach ($mentor_target_keywords as $keyword) {
					// go through headers to find the index
					$value ="";
					for ($i=0; $i < count($headers_clone)-1; $i++) { 
						$header = $headers_clone[$i];
						if (strpos($header, $keyword) !== FALSE){
							$value = $person[$i];
							break;
						}
					}
					$mentor_values[] = $value;
				}
				// var_dump($mentor_values);
				// print("\n===============================\n");
				$leftover = array_diff($person, $mentor_values,$participant_values,array("First Choice","Second Choice","Third Choice"));
				// var_dump($leftover);
				$parameter_value = array();
				$parameter_value[] = ""; 
				$parameter_value[] = date("Y");		
				$empStat = array();	
				$extra = "{";	
				foreach ($leftover as $key => $value) {
					$title = $headers[$key];
					if ($value == "X" && $title != "CS Alumni/ae"){
						$empStat[] = $title;
					}else{
						$extra .= '"' . $title .'"' . ":" . '"' . $value .'"' . ",";
					}
				}
				$extra .= '"EmpolymentStatus" :' . '"' . implode(",", $empStat) . '"}';
				$parameter_value[] = $extra;
				// var_dump($parameter_value);
			}else{
				// construct student value array
				$student_values = array();
				foreach ($student_target_keywords as $keyword) {
					// go through headers to find the index
					$value ="";
					for ($i=0; $i < count($headers_clone)-1; $i++) { 
						$header = $headers_clone[$i];
						if (strpos($header, $keyword) !== FALSE){
							$value = $person[$i];
							break;
						}
					}
					$student_values[] = $value;
				}
				// var_dump($student_values);
				$leftover = array_diff($person, $student_values,$participant_values,array("First Choice","Second Choice","Third Choice"));
				// var_dump($leftover);
				$parameter_value = array();
				$parameter_value[] = ""; 
				$parameter_value[] = date("Y");		
				$empStat = array();	
				$extra = "{";	
				foreach ($leftover as $key => $value) {
					$title = $headers[$key];
					if ($value == "X" && $title != "CS Alumni/ae"){
						$empStat[] = $title;
					}else{
						$extra .= '"' . $title .'"' . ":" . '"' . $value .'"' . ",";
					}
				}
				$extra .= '"EmpolymentStatus" :' . '"' . implode(",", $empStat) . '"}';
				$parameter_value[] = $extra;
				// var_dump($student_values);
				var_dump($parameter_value);
				// print("\n===============================\n");
			}
			//===============================================================
			// the rest goes into extra 

			// $parameter_value = array();
			// $parameter_value[] = ""; // pid 
			// $parameter_value[] = date("Y");
			// for ($i=0; $i < count($headers_clone)-1; $i++) { 
			// 	$header = $headers_clone[$i];
			// 	if (strpos($header, $keyword) !== FALSE){
			// 		$value = $person[$i];
			// 		unset($headers_clone[$i]);
			// 		unset($person[$i]);
			// 		break;
			// 	}
			// }
			break;
		}

	}	
	public function format_date($arrayOfDate){
		$result = array();
		foreach ($arrayOfDate as $key) {
			$result[] = date("Y-m-d", strtotime($key));
		}
		return $result;
	}


	
}
