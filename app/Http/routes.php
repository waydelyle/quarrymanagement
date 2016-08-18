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

// MainController routes...
Route::get('/', 'MainController@show');

Route::group(['middleware' => ['auth']], function () {

    // DieselController routes...
    Route::get('diesel', 'DieselController@show');
    Route::get('diesel/update/{id}', 'DieselController@update');
    Route::post('diesel/add', 'DieselController@add');
    Route::post('diesel/subtract', 'DieselController@subtract');
    Route::post('diesel/delete', 'DieselController@delete');

    // OilController routes...
    Route::get('oil', 'OilController@show');
    Route::get('oil/update/{id}', 'OilController@update');
    Route::post('oil/add', 'OilController@add');
    Route::post('oil/subtract', 'OilController@subtract');
    Route::post('oil/delete', 'OilController@delete');

    // VehicleController routes...
    Route::get('vehicles', 'VehicleController@show');
    Route::get('vehicle/update/{id}', 'VehicleController@update');
    Route::post('vehicle/add', 'VehicleController@add');
    Route::post('vehicle/delete', 'VehicleController@delete');

    // StatsController routes...
    Route::get('stats', 'StatsController@show');
    Route::get('stats/diesel', 'StatsController@diesel');
    Route::get('stats/oil', 'StatsController@oil');

    // HistoryController routes...
    Route::get('history', 'HistoryController@show');
    Route::post('history/diesel', 'HistoryController@diesel');
    Route::post('history/oil', 'HistoryController@oil');

});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'MainController@logout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');