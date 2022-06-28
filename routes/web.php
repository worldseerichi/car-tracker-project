<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//pages
Route::get('/', [MapsController::class, 'index'])->name('dashboard');
Route::get('/g-p-s', [MapsController::class, 'index']);
Route::get('/login', [MapsController::class, 'index'])->name('login');
Route::get('/register-accounts', [MapsController::class, 'index']);

//tracking data
Route::get('/getData', [MapsController::class, 'getData']);
//Route::get('/getAdjacentData', [MapsController::class, 'getAdjacentData']);

//post tracking data
Route::post('/postData', [MapsController::class, 'postData']);
Route::post('/postDataBatch', [MapsController::class, 'postDataBatch']);

//csrf token
Route::get('/getToken', [MapsController::class, 'getToken']);

Route::resource('users','UserController');
Route::resource('rsus','RsuController');
Route::resource('trackingdata','TrackingDataController');

//auth
Route::post('login-request', [AuthController::class, 'loginRequest'])->name('login-request');
Route::post('login-request-mobile', [AuthController::class, 'loginRequestMobile'])->name('login-request-mobile');
Route::post('registration-request', [AuthController::class, 'registrationRequest'])->name('registration-request');
Route::post('signout', [AuthController::class, 'signOut'])->name('signout');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
