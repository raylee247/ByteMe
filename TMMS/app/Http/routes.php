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
Route::post('mentorform', 'appLoaderController@editForm');
Route::post('studentform', 'appLoaderController@editForm');
Route::post('mentorform', 'appLoaderController@grabMentorAppEdit');
Route::post('studentform', 'appLoaderController@grabStudentAppEdit');

Route::post('editform', 'appLoaderController@editForm');

Route::get('success', 'AdminController@downloadcsv');

// make admin
Route::get('makeadmin', 'MakeAdminController@index');
Route::post('makeadmin', 'MakeAdminController@store');

// admin home

Route::get('admin', 'AdminController@index');

// view audit log
Route::get('log', 'AdminController@viewLog');
Route::post('log', 'AdminController@viewLog2');

// participant management

Route::get('students', 'AdminController@studentsview');
Route::get('mentors', 'AdminController@mentorsview');
Route::get('waitlist', 'AdminController@waitlist');

Route::get('downloadcsv', 'AdminController@downloadcsv');
Route::post('downloadcsv2', 'AdminController@downloadcsv');
Route::post('downloadCSV', 'AdminController@downloadCSVfile');

Route::get('uploadcsv', 'uploadCSVController@index');
Route::post('uploadcsv_preview', 'uploadCSVController@preview');
Route::post('uploadcsv_uploaded', 'uploadCSVController@upload');

Route::post('students', 'AdminController@studentSearch');
Route::post('mentors', 'AdminController@mentorSearch');
Route::post('waitlist', 'AdminController@waitlistSearch');

Route::post('{pid}/pastreport', 'AdminController@viewPastReport');

//view individual participant profile
Route::get('participant/{pid}', 'AdminController@showParticipant'); 
Route::post('participant/{pid}', 'AdminController@editParticipant');

//download participant report
Route::post('downloadParticipant', 'profileController@downloadParticipant');

//Move participant to waitlist pool
Route::post('toWaitlistPool', 'profileController@toWaitlistPool');
Route::post('toParticipantPool', 'profileController@toParticipantPool');
// match making

// TODO current match + saved matches needs to be put in a controller


Route::get('weight', 'weightController@index');
Route::post('matchresult', 'weightController@matchresultindex');
Route::get('savedmatches', 'weightController@savedmatchesindex');
Route::post('savedmatches', 'weightController@savedmatchname');
Route::post('kickoffmatches', 'weightController@savedmaxKickoff');
Route::get('currentmatch', 'weightController@currentmatchindex');

//==== for unit testing purpose 
Route::get("test", "MakeMatching@generateMatchTest");
Route::get('ray', 'appLoaderController@test');
//====

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
