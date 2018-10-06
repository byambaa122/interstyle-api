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

// Route::middleware('auth:api')->group(function () {
	Route::get('user', 'AppController@getUser');
	Route::post('image/upload', 'ImageController@upload');

	Route::namespace('Manage')->group(function () {
        // Materials route
        Route::get('materials', 'MaterialController@get');
        Route::get('materials/{id}', 'MaterialController@show');
        Route::post('materials', 'MaterialController@storeOrUpdate');
        Route::delete('materials/{id}', 'MaterialController@destroy');

        // Material categories route
        Route::get('material/categories', 'MaterialCategoryController@get');
        Route::get('material/categories/{id}', 'MaterialCategoryController@show');
        Route::post('material/categories', 'MaterialCategoryController@storeOrUpdate');
        Route::delete('material/categories/{id}', 'MaterialCategoryController@destroy');

        // Products route
        Route::get('products', 'ProductController@get');
        Route::get('products/{id}', 'ProductController@show');
        Route::post('products', 'ProductController@storeOrUpdate');
        Route::delete('products/{id}', 'ProductController@destroy');

        // Product categories route
        Route::get('product/categories', 'MaterialCategoryController@get');
        Route::get('product/categories/{id}', 'MaterialCategoryController@show');
        Route::post('product/categories', 'MaterialCategoryController@storeOrUpdate');
        Route::delete('product/categories/{id}', 'MaterialCategoryController@destroy');
    });
// });
