<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/login', 'LoginController@getIndex');
Route::post('/login/verify', array('before' => 'guest', 'uses' => 'LoginController@verify'));
Route::get('/home', array('before' => 'auth', 'uses' => 'HomeController@getIndex'));
