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


Route::get('/department', 'DepartmentController@index');
Route::post('/department/store', 'DepartmentController@store');
Route::post('/department/update', 'DepartmentController@update');

Route::get('/project', 'ProjectController@index');
Route::post('/project/store', 'ProjectController@store');
Route::post('/project/update', 'ProjectController@update');

Route::get('/employee', 'EmployeeController@index');
Route::post('/employee/store', 'EmployeeController@store');
Route::post('/employee/update', 'EmployeeController@update');
Route::get('/employee/user', 'EmployeeController@getNullUser');
Route::post('/employee/assignCompensation', 'EmployeeController@assignCompensation');

Route::post('/user/createUser', 'UserController@createUser');
Route::post('/login', 'UserController@login');

Route::post('/send', 'ForgotPasswordController@sendEmail');
Route::post('/confirmCode', 'ForgotPasswordController@checkCode');
Route::post('/changePassword', 'ForgotPasswordController@changePassword');
