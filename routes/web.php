<?php

use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

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

Route::get('/', [MainPageController::class, 'index'])->name('banners');

Route::get('/orders', function () {})->name('orders.create');

Route::get('/cart', function () {})->name('carts.edit');

Route::get('/discounts', function () {})->name('discounts.index');

Route::get('/products', function () {})->name('products.index');

Route::get('/feedbacks', function () {})->name('feedbacks.create');

Route::get('/products/comparison', function () {})->name('comparison');

Route::get('/cart', function () {})->name('carts.edit');

Route::get('/account', function () {})->middleware('access:account')->name('account.show');

Route::get('/about', function () {})->name('about');

Route::get('sellers/{id}', [\App\Http\Controllers\SellerController::class, 'show']);
