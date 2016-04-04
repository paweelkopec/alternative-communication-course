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
 
Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    
    Route::get('/courses', 'CourseController@index');
    Route::post('/course', 'CourseController@store');
    Route::delete('/course/{course}', 'CourseController@destroy');
    Route::get('/course/{course}', 'CourseController@detail');
    Route::put('/course/{course}', 'CourseController@edit');
    Route::get('/account', 'AccountController@account');
    Route::put('/account', 'AccountController@edit');
    Route::get('/study/{course}', 'StudyController@index');
    Route::get('/file/{file}', 'StudyController@image');
    
    Route::auth();

});