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
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::get('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\LoginController@register');



Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('projects', API\ProjectController::class);
    Route::post('tasks/archive', 'API\TaskController@archive');
    Route::resource('tasks', API\TaskController::class);
});
