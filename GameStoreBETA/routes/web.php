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
Route::get('/friends', [PagesController::class, 'friends']);
Route::get('/chat/{username}', [PagesController::class, 'chat']);


  Route::get('/login','LoginController@show_login_form')->name('Login');
  Route::post('/login','LoginController@process_login')->name('Loginn');
  Route::get('/register','LoginController@show_signup_form')->name('Register');
  Route::post('/register','LoginController@process_signup');
  Route::post('/logout','LoginController@logout')->name('Logout');


Auth::routes();