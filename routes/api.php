<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Auth')->group(function () {
	Route::post('login', 'LoginController@login');
	Route::post('register', 'RegisterController@register');
});

Route::post('image/upload', 'ImageController@upload');

Route::middleware('auth:api')->group(function () {
	Route::get('user', 'AppController@getUser');
	// Route::post('image/upload', 'ImageController@upload');
    //
});
