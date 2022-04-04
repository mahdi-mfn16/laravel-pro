<?php

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

Route::get('/', function () {
    
    return view('welcome');
});

Auth::routes();

Route::get('/auth/google' , 'Auth\GoogleAuthController@redirect')->name('google.auth');
Route::get('/auth/google/callback' , 'Auth\GoogleAuthController@callback');

Route::get('/auth/token-verify' , 'Auth\TokenVerifyController@getTokenVerify')->name('token-verify');
Route::post('/auth/token-verify' , 'Auth\TokenVerifyController@postTokenVerify');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::get('/profile' , 'ProfileController@index')->name('profile');
    Route::get('/profile/two-verify' , 'ProfileController@twoVerify')->name('two-verify');
    Route::post('/profile/two-verify' , 'ProfileController@postTwoVerify');
    Route::get('/profile/phone-sms-verify' , 'ProfileController@phoneSmsVerify')->name('phone-sms');
    Route::post('/profile/phone-sms-verify' , 'ProfileController@postPhoneSmsVerify');

});
