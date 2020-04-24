<?php

Route::get('/', 'FrontendController@index');

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider')->name('login.social');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.social.callback');

// Abandoned HomeController
// Route::get('/home', 'HomeController@index')->name('home');

// Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard');
    })->name('admin');
    
    Route::get('category', 'CategoryController@index')->name('category.index');
    Route::post('category/store', 'CategoryController@store')->name('category.store');
    Route::put('category/{category}/update', 'CategoryController@update')->name('category.update');
    Route::delete('category/{category}/destroy', 'CategoryController@destroy')->name('category.destroy');
    
    Route::get('product', 'ProductController@index')->name('product.index');
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::post('product', 'ProductController@store')->name('product.store'); // removed product/store
    Route::get('product/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::put('product/{product}/update', 'ProductController@update')->name('product.update');
    Route::delete('product/{product}/destroy', 'ProductController@destroy')->name('product.destroy');
    Route::delete('product/deletemultiple', 'ProductController@deleteMultiple')->name('product.deletemultiple');
    
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::get('users/create', 'UsersController@create')->name('users.create');
    Route::post('users/store', 'UsersController@store')->name('users.store');
    Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
    Route::put('users/{user}/update', 'UsersController@update')->name('users.update');
    Route::delete('users/{user}/destroy', 'UsersController@destroy')->name('users.destroy');
    
    Route::get('stores', 'StoreController@index')->name('stores.index');
    Route::post('stores', 'StoreController@store')->name('stores.store');
    Route::put('stores/{store}/update', 'StoreController@update')->name('stores.update');
    Route::delete('stores/{store}/destroy', 'StoreController@destroy')->name('stores.destroy');
    
    Route::get('sliders', 'SliderController@index')->name('sliders.index');
    Route::post('sliders', 'SliderController@store')->name('sliders.store');
    Route::put('sliders/{slider}', 'SliderController@update')->name('sliders.update');
    Route::delete('sliders/{slider}', 'SliderController@destroy')->name('sliders.destroy');
    Route::put('save-sliders-settings', 'SliderController@saveSettings')->name('sliders.settings.update');

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

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
    Route::get('/my-profile', 'UserController@profile')->name('customer');
    Route::get('/profile', 'UserController@profile')->name('user.profile');
    Route::put('/profile/update/{user}', 'UserController@updateProfile')->name('user.profile.update');
    Route::put('/profile/password/{user}', 'UserController@changePassword')->name('user.password.update');
    Route::post('/profile/picture/{user}', 'UserController@changeProfilePic')->name('ajax.user.profile.pic.update');
    Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
    Route::post('/order', 'OrderController@store')->name('order.store');
    Route::get('/orders', 'OrderController@myOrders')->name('customer.orders');
});

Route::group(['middleware' => ['auth']], function () {
    // registered users with policy
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
    Route::put('/orders/{order}/update', 'OrderController@update')->name('orders.update');
    Route::delete('/orders/{order}', 'OrderController@destroy')->name('orders.destroy');
    
    // Ledger Book
    Route::get('/ledgers', 'LedgerEntryController@index')->name('ledgers.index');
    Route::get('/ledgers/{store}', 'LedgerEntryController@show')->name('ledgers.show');
    Route::post('/store/{store}/ledgers', 'LedgerEntryController@store')->name('ledgers.store');
    Route::get('ajax/ledgers/stores', 'LedgerEntryController@storesList')->name('ajax.ledgers.stores_list');
});

// anyone
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/items', 'CartController@getItems')->name('cart.items');
Route::get('/cart/summary', 'CartController@summary')->name('cart.items.summary');
Route::post('/cart/add', 'CartController@add')->name('cart.add');
Route::post('/cart/update', 'CartController@update')->name('cart.update');


// all registered users
Route::group(['prefix' => 'ajax', 'middleware' => ['auth']], function() {
    Route::get('order/new/count', 'AjaxController@newOrdersCount')->name('ajax.order.new.count');
});

// temporary test routes
Route::get('privacy-policy', function () {
    return view('policy');
});
Route::get('cart/destroy', function(){
    Cart::destroy();
});

Route::group(['prefix' => 'test', 'middleware' => ['checkrole:admin,user']], function () {
    Route::get('/role', function () {
        return "passed";
    });
});

// Route::get('/ledger/{store_id}', function ($store_id) {
//     // dd(LedgerEntry::credit($store_id, 100, 'Order #121'));
//     dd(LedgerEntry::debit($store_id, 100, 'Order #121'));
//     return 'done';
// });

Route::get('ajax/push-sales-products', 'AjaxController@pushSalesProducts')->name('ajax.push_sales_products');
