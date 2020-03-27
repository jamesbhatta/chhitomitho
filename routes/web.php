<?php
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.social.callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@profile')->name('user.profile');
Route::put('/profile/update/{user}', 'UserController@updateProfile')->name('user.profile.update');

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('admin');

    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::put('category/{category}/update', 'CategoryController@update')->name('category.update');
    Route::delete('category/{category}/destroy', 'CategoryController@destroy')->name('category.destroy');
});

Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'manager']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('manager');
});

Route::group(['prefix' => 'partner', 'middleware' => ['auth', 'partner']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('partner');
});

Route::group(['prefix' => 'courier', 'middleware' => ['auth', 'courier']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('courier');
});

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('customer');
});
