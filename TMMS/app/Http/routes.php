<?php

require_once app_path('logger.php');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('testDBselect', 'testDBController@DBSelect');

Route::get('/', 'WelcomeController@index');

Route::get('hello_world', 'WelcomeController@hello');

Route::get('home', 'HomeController@index');


//application forms

Route::get('studentapp', 'StudentAppController@index');

Route::get('mentorapp', 'MentorAppController@index');

Route::get('submit', ['as' => 'studentapp', 'uses' => 'StudentAppController@create']);

Route::post('submit', ['as' => 'studentapp_store', 'uses' => 'StudentAppController@store']);

// make admin
Route::get('makeadmin', 'MakeAdminController@index');
Route::post('makeadmin', 'MakeAdminController@store');

// admin home

Route::get('admin', 'AdminController@index');

// view audit log
Route::get('log', 'AdminController@viewLog');

// participant management

Route::get('students', 'AdminController@studentsview');
Route::get('mentors', 'AdminController@mentorsview');
Route::get('waitlist', 'AdminController@waitlist');

Route::get('downloadcsv', 'AdminController@downloadcsv');
Route::get('downloadCSV', 'AdminController@downloadCSVfile');

Route::get('uploadcsv', 'uploadCSVController@index');
Route::post('uploadCSV', 'uploadCSVController@upload');

Route::post('studentSearch', 'AdminController@studentSearch');

// match making

// TODO current match + saved matches needs to be put in a controller
//Route::get('currentmatch', '')
//Route::get('savedmatches', '')
Route::get('weight', 'weightController@index');

// application form ROUTES
//Route::get('studentform', '')
//Route::get('mentorform', '')
//////////////////////////////////

//==== for unit testing purpose 
Route::get("test", "MakeMatching@generateMatch");
//====

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
