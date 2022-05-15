<?php

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

Route::get('/', [MapsController::class, 'index']);
Route::get('/g-p-s', [MapsController::class, 'index']);
Route::get('/getData', [MapsController::class, 'getData']);
