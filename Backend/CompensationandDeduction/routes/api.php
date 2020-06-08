<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Compensation API
Route::get('/compensation', 'CompensationController@index');
Route::post('/compensation/store', 'CompensationController@store');
Route::post('/compensation/update', 'CompensationController@update');