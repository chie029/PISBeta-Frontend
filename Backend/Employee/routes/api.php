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

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

// 	Route::post('/user/login', 'UserController@login');

// 	Route::get('/department', 'DepartmentController@index');
// 	Route::post('/department/store', 'DepartmentController@store');
// 	Route::post('/department/update', 'DepartmentController@update');

// });

Route::post('/user/createUser', 'UserController@createUser');
Route::get('/user/getUsers', 'UserController@getUsers');
Route::post('/user/login', 'UserController@login');

Route::get('/department', 'DepartmentController@index');
Route::post('/department/store', 'DepartmentController@store');
Route::post('/department/update', 'DepartmentController@update');

Route::get('/project', 'ProjectController@index');
Route::post('/project/store', 'ProjectController@store');
Route::post('/project/update', 'ProjectController@update');

Route::get('/employee', 'EmployeeController@index');
Route::post('/employee/show', 'EmployeeController@show');
Route::post('/employee/store', 'EmployeeController@store');
Route::post('/employee/edit', 'EmployeeController@edit');
Route::post('/employee/update', 'EmployeeController@update');
Route::get('/employee/user', 'EmployeeController@getNullUser');
Route::post('/employee/assignCompensation', 'EmployeeController@assignCompensation');

Route::post('/send', 'ForgotPasswordController@sendEmail');
Route::post('/confirmCode', 'ForgotPasswordController@checkCode');
Route::post('/changePassword', 'ForgotPasswordController@changePassword');
