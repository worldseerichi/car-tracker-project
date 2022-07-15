<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapsController;
use App\Http\Controllers\UserController;
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

//Route::get('/{any}', [MapsController::class, 'index'])->where('any', '.*');

//Pages
Route::get('/', [MapsController::class, 'index']);
Route::get('/g-p-s', [MapsController::class, 'index']);
Route::get('/login', [MapsController::class, 'index']);
Route::get('/manage-accounts', [MapsController::class, 'index']);
