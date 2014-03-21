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

Route::get('test', function() {
    dd(Hash::make('wow'));
    });
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));



Route::group(array('before' => 'guest'), function() {
  Route::get('/login', array('as' => 'login', 'uses' => 'LoginController@index'));
  Route::post('/login/verify', array('before' => 'guest', 
                                     'as' => 'login.verify', 
                                     'uses' => 'LoginController@verify'));
});

Route::group(array('before' => 'auth|admin'), function() {
  Route::get('/user', array('as' => 'user.index', 'uses' => 'UserController@index'));
  Route::get('/user/create', array('as' => 'user.create', 'uses' => 'UserController@create'));
  Route::post('/user', array('as' => 'user.store', 'uses' => 'UserController@store'));
  Route::get('/user/create_login/{id}', array('as' => 'user.create_login', 'uses' => 'UserController@create_login'));
  Route::post('/user/create_login', array('as' => 'user.store_login', 'uses' => 'UserController@store_login'));
  Route::get('/user/{id}/add_doctor', array('as' => 'user.add_doctor', 'uses' => 'UserController@add_doctor'));
  Route::post('user/{id}/add_doctor', array('as' => 'user.store_doctor', 'uses' => 'UserController@store_doctor'));
  Route::post('user/{id}/remove_doctor', array('as' => 'user.remove_doctor', 'uses' => 'UserController@remove_doctor'));
  });

Route::group(array('before' => 'auth|radiologist'), function() {
  Route::get('record/create', array('as' => 'record.create', 'uses' => 'RecordController@create'));
  Route::post('record', array('as' => 'record.store', 'uses' => 'RecordController@store'));


});

//TODO
Route::get('record/{id}/{img_size?}', array('as' => 'record.show', 'uses' => 'RecordController@show'));


Route::group(array('before' => 'auth'), function() {
  Route::get('logout', array('as' => 'logout', 'uses' => 'LoginController@logout'));
  Route::get('/user/{id}/edit', array('as' => 'user.edit', 'uses' => 'UserController@edit'));
  Route::post('/user/{id}', array('as' => 'user.update', 'uses' => 'UserController@update'));
  Route::post('/userlogin/{name}', array('as' => 'user.updateLogin', 'uses' => 'UserController@updateLogin'));
});
