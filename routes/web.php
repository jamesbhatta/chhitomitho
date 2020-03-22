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

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback')->name('login.social.callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@profile')->name('user.profile');
Route::put('/profile/update/{user}', 'UserController@updateProfile')->name('user.profile.update');