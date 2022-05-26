<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MapsController::class, 'index'])->name('dashboard');
Route::get('/g-p-s', [MapsController::class, 'index']);
Route::get('/login', [MapsController::class, 'index'])->name('login');
Route::get('/register-accounts', [MapsController::class, 'index']);

Route::get('/getData', [MapsController::class, 'getData']);

Route::resource('users','UserController');
Route::resource('rsus','RsuController');
Route::resource('trackingdata','TrackingDataController');

Route::post('login-request', [AuthController::class, 'loginRequest'])->name('login-request');
Route::post('registration-request', [AuthController::class, 'registrationRequest'])->name('registration-request');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

//routes for middleware checking
Route::get('loginCheck', [AuthController::class, 'currentUser'])->name('loginCheck');
