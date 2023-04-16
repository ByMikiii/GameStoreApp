<?php

use App\Http\Controllers\FriendController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GlobalMessageController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PurchaseController;
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
Route::get('/game/{gameslug}', [PagesController::class, 'game']);
Route::get('/library', [PagesController::class, 'library'])->middleware('auth');
Route::get('/community', [PagesController::class, 'community']);
Route::get('/profile', [PagesController::class, 'profile'])->middleware('auth');
Route::get('/profile/edit', [PagesController::class, 'editprofile'])->middleware('auth');
Route::get('/user/{username}', [PagesController::class, 'user']);
Route::get('/friends', [PagesController::class, 'chat'])->middleware('auth');
Route::get('/chat', [PagesController::class, 'chat'])->middleware('auth');
Route::get('/chat/{username}', [PagesController::class, 'chat'])->middleware('auth');
Route::get('/balance', [PagesController::class, 'balance'])->middleware('auth');
Route::get('/basket', [PagesController::class, 'basket'])->middleware('auth');


  Route::get('/lang/{lang}', [LangController::class, 'index']);
  Route::get('/changelang/{lang}', [LangController::class, 'changelang']);

  Route::get('/login','LoginController@show_login_form')->name('Login');
  Route::post('/login','LoginController@process_login')->name('Loginn');
  Route::get('/register','LoginController@show_signup_form')->name('Register');
  Route::post('/register','LoginController@process_signup');
  Route::post('/logout','LoginController@logout')->name('Logout');

  Route::get('/stripe', [StripePaymentController::class, 'stripe']);
  Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

  //Friends
  Route::get('/getFriendsIds', [FriendController::class, 'getFriends'])->middleware('auth');
  Route::get('/getPendingFriendsToIds', [FriendController::class, 'getPendingFriendsTo'])->middleware('auth');
  Route::get('/getPendingFriendsFromIds', [FriendController::class, 'getPendingFriendsFrom'])->middleware('auth');

  Route::post('/friends/create/{friend_id}', [FriendController::class, 'create'])->middleware('auth');
  Route::patch('/friends/update/{friend_id}', [FriendController::class, 'update'])->middleware('auth');
  Route::delete('/friends/delete/{friend_id}', [FriendController::class, 'destroy'])->middleware('auth');

  //Games
  Route::get('/getGame/{game_name}/{genre}/{sort}', [GamesController::class, 'getGame']);

  //Global messages
  Route::get('/globalmessages', [GlobalMessageController::class, 'index'])->middleware('auth');
  Route::post('/globalmessages', [GlobalMessageController::class, 'store'])->middleware('auth');

  //Messages
  Route::get('/messages/{id}', [MessageController::class, 'index'])->middleware('auth');
  Route::post('/messages', [MessageController::class, 'store'])->middleware('auth');

  //Stripe Payment
  Route::get('/getSession/{amount}', [StripePaymentController::class, 'getSession'])->middleware('auth');
  Route::get('/success' , [PagesController::class, 'index'])->middleware('auth');
  Route::get('/cancel', [PagesController::class, 'index'])->middleware('auth');

  //Basket 
  Route::get('/basketItems', [BasketController::class, 'index'])->middleware('auth');
  Route::post('/addToBasket/{game_id}', [BasketController::class, 'store'])->middleware('auth');
  Route::delete('/basket/delete/{game_id}', [BasketController::class, 'destroy'])->middleware('auth');

  //Purchases
  Route::post('/makePurchase', [PurchaseController::class, 'makePurchase'])->middleware('auth');
  Route::get('/loggedUserBalance', [UserController::class, 'balance'])->middleware('auth');

  //Reviews
  Route::post('/addReview', [ReviewController::class, 'store'])->middleware('auth');
  Route::delete('/deleteReview/{game_id}', [ReviewController::class, 'destroy'])->middleware('auth');


  //Any other page
  Route::get('{any}', [PagesController::class, 'index']);



  Auth::routes();