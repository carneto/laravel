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


Route::auth();

Route::group(['middleware' => 'auth'], function () {

	Route::get('/',            'HomeController@index');
    Route::get('/home',        'HomeController@index');
    Route::get('/user',        'UserController@index');
    Route::get('/adaccount',   'ADAccountController@index');

    Route::post('/ajax/adtable'          , 'Ajax\ADTable@index');
    Route::post('/ajax/adtable/update'   , 'Ajax\ADTable@update');

    //test
    Route::get('/ajax/adtable','Ajax\ADTable@index');
    Route::get('/test','Ajax\ADTable@test');
	    
	
});








