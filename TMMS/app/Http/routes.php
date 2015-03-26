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
Route::get('testEmail', 'testEmailController@index');

Route::get('downloademails', 'testEmailController@downloadEmails');

Route::get('testDBselect', 'testDBController@DBSelect');

Route::get('/', 'WelcomeController@index');

Route::get('hello_world', 'WelcomeController@hello');

Route::get('home', 'HomeController@index');

Route::get('about', 'aboutController@index');

//application forms

Route::get('studentapp', 'appLoaderController@grabStudentApp');
Route::get('mentorapp', 'appLoaderController@grabMentorApp');
Route::post('mentorapp', 'appLoaderController@mentorToDB');
Route::post('studentapp', 'appLoaderController@studentToDB');
//Route::post('mentorapp', 'appLoaderController@index');

// edit application forms
Route::get('studentform', 'appLoaderController@grabStudentAppEdit');
Route::get('mentorform', 'appLoaderController@grabMentorAppEdit');

Route::get('success', 'AdminController@downloadcsv');

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
Route::post('uploadcsv_preview', 'uploadCSVController@preview');
Route::post('uploadcsv_uploaded', 'uploadCSVController@upload');

Route::post('students', 'AdminController@studentSearch');
Route::post('mentors', 'AdminController@mentorSearch');
Route::post('waitlist', 'AdminController@waitlistSearch');

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
Route::get("test", "MakeMatching@generateMatchTest");
Route::get('ray', 'appLoaderController@index');
//====

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
