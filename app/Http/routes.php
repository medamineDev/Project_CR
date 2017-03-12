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

Route::get('/dash', function () {
    return view('dashBoard');
});


Route::get('/',['middleware' => ['auth'] , 'uses'=>"HomeController@index"]);
Route::get('/userList',['middleware' => ['auth'] , 'uses'=>"Auth\UserController@getUserList"]);
Route::get('/removeUser/{userId}',['middleware' => ['auth'] , 'uses'=>"Auth\UserController@removeUser"]);

Route::auth();


