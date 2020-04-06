<?php
Route::get('/', function () {
    $categories = \App\Category::with('products')->ordered()->get();
    return view('welcome', compact('categories'));
});

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.social.callback');

Route::get('/home', 'HomeController@index')->name('home');

// Admin
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

// Manager
Route::group(['prefix' => 'manager', 'middleware' => ['auth', 'manager']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('manager');
});

//partner
Route::group(['prefix' => 'partner', 'middleware' => ['auth', 'partner']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('partner');
});

// courier
Route::group(['prefix' => 'courier', 'middleware' => ['auth', 'courier']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('courier');
});

// customers
Route::group(['prefix' => 'customer', 'middleware' => ['auth', 'customer']], function () {
    Route::get('/', 'UserController@profile')->name('customer');
    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::put('/profile/update/{user}', 'UserController@updateProfile')->name('user.profile.update');
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/order', 'OrderController@store')->name('order.store');
    Route::get('/orders', 'OrderController@myOrders')->name('customer.orders');
});

// registered users with policy
Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
Route::put('/orders/{order}/update', 'OrderController@update')->name('orders.update');
Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');

// anyone
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/items', 'CartController@getItems')->name('cart.items');
Route::get('/cart/summary', 'CartController@summary')->name('cart.items.summary');
Route::post('/cart/add', 'CartController@add')->name('cart.add');
Route::post('/cart/update', 'CartController@update')->name('cart.update');


// all registered users
Route::group(['middleware' => ['auth']], function() {
    
});

// temporary test routes
Route::get('cart/destroy', function(){
    Cart::destroy();
});

Route::group(['prefix' => 'test', 'middleware' => ['checkrole:admin,user']], function () {
    Route::get('/role', function () {
        return "passed";
    });
});