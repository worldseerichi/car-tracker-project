<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Tracking Data
Route::get('/getData', [MapsController::class, 'getData']);
Route::get('/getDataFiltered', [MapsController::class, 'getDataFiltered']);
Route::get('/getDataExport/{location}/{range}/{start_date}/{end_date}', [MapsController::class, 'getDataFilteredExport']);
Route::get('/getDataCounted', [MapsController::class, 'getDataCounted'])->withTrashed();

//Post Tracking Data / Write Data
Route::post('/postData', [MapsController::class, 'postData']);
Route::post('/postDataBatch', [MapsController::class, 'postDataBatch']);
Route::post('/postDataTesting', [MapsController::class, 'postDataTesting']); //for testing purposes

//Csrf Token for Postman testing
Route::get('/getToken', [MapsController::class, 'getToken']);

//Auth
Route::post('login-request', [AuthController::class, 'loginRequest']);
Route::post('login-request-mobile', [AuthController::class, 'loginRequestMobile']);
Route::post('login-device', [AuthController::class, 'loginRequestDeviceID']);
Route::post('registration-request', [AuthController::class, 'registrationRequest']);
Route::post('signout', [AuthController::class, 'signOut']);

//SoftDelete and Restore
Route::delete('users/{id}', [UserController::class, 'destroy']);
Route::get('users/restore/{id}', [UserController::class, 'restore']);
