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

//Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
//Route::post('recover', 'Api\AuthController@recover');

Route::group(['middleware' => ['jwt.auth']], function() {

    Route::resource('people', 'Api\PersonController');
    Route::resource('locations', 'Api\LocationController');
    Route::post('logout', 'Api\AuthController@logout');

});
