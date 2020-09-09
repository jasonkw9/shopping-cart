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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('add-to-cart/{id}', 'ItemsController@addToCart');
Route::get('/cart', "ItemsController@showCart")->name('cart');
Route::patch('/update-cart', "ItemsController@updateCart")->name('updateCart');
Route::delete('/remove-cart', "ItemsController@removeCart")->name('removeCart');
Route::resource('shop', 'ItemsController', [
    'names' => [
        'index' => 'shop',
        'store' => 'faq.new'
    ]
]);
Route::resource('payment', 'PaymentController', [
    'names' => [
        'index' => 'payment'
    ]
]);
Route::post('process', 'PaymentController@process')->name('process');
Route::get('user/{id}', 'UserController@getUserDetails')->middleware('is_admin');
Route::get('items', 'ItemsController@listAllItems')->middleware('is_admin')->name('item');
Route::get('items/{id}', 'ItemsController@getItemDetails')->middleware('is_admin')->name('itemDetails');
Route::resource('user', 'UserController', [
    'names' => [
        'index' => 'user'
    ]
])->middleware('is_admin');
