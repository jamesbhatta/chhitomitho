<?php
Route::get('/', function () {
    $categories = \App\Category::with('products')->latest()->get();
    return view('welcome', compact('categories'));
});

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.social.callback');

Route::get('/home', 'HomeController@index')->name('home');



Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('admin');
    
    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::put('category/{category}/update', 'CategoryController@update')->name('category.update');
    Route::delete('category/{category}/destroy', 'CategoryController@destroy')->name('category.destroy');
    
    Route::get('product', 'ProductController@index')->name('product.index');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::get('product/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::put('product/{product}/update', 'ProductController@update')->name('product.update');
    Route::delete('product/{product}/destroy', 'ProductController@destroy')->name('product.destroy');
    
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::get('users/create', 'UsersController@create')->name('users.create');
    Route::post('users/store', 'UsersController@store')->name('users.store');
    Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('users/{user}/update', 'UsersController@update')->name('users.update');
    Route::delete('users/{user}/destroy', 'UsersController@destroy')->name('users.destroy');
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
\
Route::group(['prefix' => 'courier', 'middleware' => ['auth', 'courier']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('courier');
});

Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('/', 'UserController@profile')->name('customer');

    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::put('/profile/update/{user}', 'UserController@updateProfile')->name('user.profile.update');
});
