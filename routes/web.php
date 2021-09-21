<?php

use App\Http\Controllers\CatalogPageController;
use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\UserController;
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

Route::get('/catalog', [CatalogPageController::class, 'index'])->name('catalog.index');

Route::get('/catalog/{slug}', [CatalogPageController::class, 'getProductForCatalogByCategorySlug'])->name('catalog.category');

Route::get('/product/{slug}', [CatalogPageController::class, 'getByCategory'])->name('product.show');

Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
Route::post('/feedbacks', [FeedbackController::class, 'sendMessage'])->name('feedbacks.send_message');

Route::get('/products/comparison', function () {})->name('comparison');

Route::get('/cart', function () {})->name('carts.edit');

Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');

Route::get('sellers/{id}', [\App\Http\Controllers\SellerController::class, 'show']);

Route::view('/about', 'about.main')->name('about');
