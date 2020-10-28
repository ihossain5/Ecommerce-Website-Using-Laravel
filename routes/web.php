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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('subcategories/{id}', 'ProductController@loadSubCategories');

Route::group(['prefix' => 'auth', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::resource('category', 'CategoryController');

    Route::resource('subcategory', 'SubcategoryController');

    Route::resource('product', 'ProductController');

    Route::get('user/all', 'UserController@index')->name('user.index');
    Route::delete('user/remove/{id}', 'UserController@destroy')->name('user.destroy');

    Route::get('slider', 'SliderController@index')->name('slider.index');

    Route::get('slider/create', 'SliderController@create')->name('slider.create');

    Route::post('slider/store', 'SliderController@store')->name('slider.store');

    Route::delete('slider/delete/{id}', 'SliderController@destroy')->name('slider.destroy');

    Route::get('/orders', 'CartController@UserOrder')->name('order.index');

    Route::get('/orders/view/{userid}/{orderid}', 'CartController@vewUserOrder')->name('order.user');
});

Route::get('/', 'FrontProductController@index');

Route::get('/all/products', 'FrontProductController@moreProduct')->name('product.more');

Route::get('/product/{id}', 'FrontProductController@show')->name('product.show');

Route::get('/category/{name}', 'FrontProductController@allProduct')->name('product.list');

Route::get('/addTocart/{product}', 'CartController@addToCart')->name('cart.add');

Route::get('/cart', 'CartController@showCart')->name('cart.show');

Route::post('/products/{product}', 'CartController@updateCart')->name('cart.update');

Route::post('/product/{product}', 'CartController@removeCart')->name('cart.remove');

Route::get('/checkout/{amount}', 'CartController@checkout')->name('cart.checkout')->middleware('auth');

Route::post('/charge', 'CartController@charge')->name('cart.charge');

Route::get('/orders', 'CartController@order')->name('order')->middleware('auth');
