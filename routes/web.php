<?php

use Illuminate\Http\Request;

Route::get('/', 'PagesController@index'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// User
Route::namespace('Customer')->middleware('auth')->group(function () {
    // Product
    Route::get('/view-products', 'ProductController@index')->name('user-products');
    Route::get('/view-product/{slug}', 'ProductController@readSingle');

    // Order
    Route::get('/view-orders', 'OrderController@index');

    // Cart
    Route::get('/view-cart', 'CartController@index')->name('user-carts');
    Route::post('/create-cart/{slug}', 'CartController@create');
    Route::get('/user/remove-all', 'CartController@removeAll');
    Route::get('/user/delete-item/{slug}', 'CartController@delete');

    // Purchases
    Route::get('/user/checkout', 'CheckoutController@checkout')->name('checkout');
    Route::get('/purchases', 'PurchaseController@index');

    // Payments
    Route::post('/user/payment/stripe', 'PaymentController@stripe')->name('user.payment.stripe');
    Route::post('/update-address', 'CheckoutController@updateAddress'); 
});

// Admin
Route::namespace('Admin')->middleware('admin')->group(function () {
    // Users Table
    Route::get('/create-user', 'UserController@create');
    Route::get('/read-users', 'UserController@read')->name('users');
    Route::get('/read-user/{slug}', 'UserController@readSingle');
    Route::get('/edit-user/{slug}', 'UserController@edit');
    Route::get('/delete-user/{slug}', 'UserController@delete');
    Route::post('/search-user', 'UserController@search');
    Route::post('/store-user', 'UserController@store');
    Route::post('/update-user', 'UserController@update');

    Route::get('/read-user/user-cart/{slug}', 'UserController@userCart');
    Route::get('/read-user/user-purchase/{slug}', 'UserController@userPurchase');
    Route::get('/read-user/user-transaction/{slug}', 'UserController@userTransaction');

    // Products Table
    Route::get('/create-product', 'ProductController@create');
    Route::get('/read-products', 'ProductController@read')->name('products');
    Route::get('/read-product/{slug}', 'ProductController@readSingle');
    Route::get('/edit-product/{slug}', 'ProductController@edit');
    Route::get('/delete-product/{slug}', 'ProductController@delete');
    Route::post('/store-product', 'ProductController@store');
    Route::post('/update-product/{slug}', 'ProductController@update');

    // Purchases Table
    Route::get('/create-order', 'OrderController@create');
    Route::get('/read-orders', 'OrderController@read')->name('orders');
    Route::get('/edit-order/{slug}', 'OrderController@edit');
    Route::get('/delete-order/{slug}', 'OrderController@delete');
    Route::post('/store-order', 'OrderController@store');
    Route::post('/update-order', 'OrderController@update');

    // Transactions Table
    Route::get('/create-transaction', 'TransactionController@create');
    Route::get('/read-transactions', 'TransactionController@read')->name('transactions');
    Route::get('/delete-transaction/{slug}', 'TransactionController@delete');
    Route::get('/update-transaction/{slug}', 'TransactionController@edit');
    Route::get('/delete-transaction/{slug}', 'TransactionController@delete');

    // Carts Table
    Route::get('/read-carts', 'CartController@read')->name('carts');
    Route::get('/delete-cart/{slug}', 'CartController@delete');
    Route::get('/update-cart/{slug}', 'CartController@edit');
    Route::get('/delete-cart/{slug}', 'CartController@delete');

    // Shippings Table
    Route::get('/create-shipping', 'ShippingController@create');
    Route::get('/read-shippings', 'ShippingController@read')->name('shippings');
    Route::get('/delete-shipping/{slug}', 'ShippingController@delete');
    Route::get('/update-shipping/{slug}', 'ShippingController@edit');
    Route::get('/delete-shipping/{slug}', 'ShippingController@delete');

    // Purchase Table
    Route::resource('purchase', 'PurchaseController');
    Route::post('/update-sent/{slug}', 'PurchaseController@updateSent'); 
});