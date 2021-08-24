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
    return view('main');
})->name('banners');

Route::get('/orders', function () {})->name('orders.create');

Route::get('/cart', function () {})->name('carts.edit');

Route::get('/delivery', function () {})->name('delivery');

Route::get('/discounts', function () {})->name('discounts');

Route::get('/products', function () {})->name('products.index');

Route::get('/feedbacks', function () {})->name('feedbacks.create');
