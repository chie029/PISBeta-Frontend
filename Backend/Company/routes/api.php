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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/company', 'CompanyController@index');
Route::get('/company/show/{id}', 'CompanyController@show');
Route::post('/company/store', 'CompanyController@store');
Route::get('/company/edit', 'CompanyController@edit');
Route::put('/company/update', 'CompanyController@update');
Route::get('/company/archived', 'CompanyController@archived');
Route::post('/company/archive', 'CompanyController@archive');
