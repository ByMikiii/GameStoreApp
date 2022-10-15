<?php

use App\Http\Controllers\PagesController;
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

Route::get('/', [PagesController::class, 'index']);
Route::get('/game/{game}', [PagesController::class, 'game']);
Route::get('/library', [PagesController::class, 'library']);
Route::get('/community', [PagesController::class, 'community']);
Route::get('/profile', [PagesController::class, 'profile']);
Route::get('/profile/{username}', [PagesController::class, 'profileUsername']);

Auth::routes();