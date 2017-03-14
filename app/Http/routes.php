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



Route::get('/userList',['middleware' => ['auth'] , 'uses'=>"Auth\UserController@getUserList"]);
Route::get('/removeUser/{userId}',['middleware' => ['auth'] , 'uses'=>"Auth\UserController@removeUser"]);
Route::get('/getUserById/{userId}',['middleware' => ['auth'] , 'uses'=>"Auth\UserController@getUserById"]);
Route::put('/editUser',['middleware' => ['auth'] , 'uses'=>"Auth\UserController@editUser"]);
Route::get('/dashMonth',['middleware' => ['auth'] , 'uses'=>"Dash\DashboardController@monthlyDashIndex"]);
Route::get('/getStats',['middleware' => ['auth'] , 'uses'=>"Dash\DashboardController@getStats"]);
Route::get('/{year?}/{month?}',['middleware' => ['auth'] , 'uses'=>"Dash\DashboardController@statsPage"]);

Route::auth();


