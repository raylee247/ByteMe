<?php

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

Route::get('/', 'WelcomeController@index');

Route::get('hello_world', 'WelcomeController@hello');

Route::get('home', 'HomeController@index');

Route::get('studentapp', 'StudentAppController@index');

Route::get('mentorapp', 'MentorAppController@index');

Route::get('admin', 'AdminController@index');

Route::get('downloadcsv', 'AdminController@downloadcsv');

Route::post('uploadCSV', 'uploadCSVController@index');

Route::get('submit', ['as' => 'register', 'uses' => 'StudentAppController@create']);

Route::post('submit', ['as' => 'register_store', 'uses' => 'StudentAppController@store']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
