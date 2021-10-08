<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogPageController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
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

Route::get('/discounts', function () {})->name('discounts.index');

Route::get('/products/{slug}', [ProductsController::class, 'show'])->name('product.show');

Route::post('/products/{slug}/add_to_cart', [ProductsController::class, 'addToCart'])
    ->name('product.addToCart');

Route::post('/products/{slug}/add_to_comparison', [ProductsController::class, 'addToComparison'])
    ->name('product.addToComparison');
Route::get('/catalog', [CatalogPageController::class, 'index'])->name('catalog.index');

Route::get('/catalog/{slug}', [CatalogPageController::class, 'getProductForCatalogByCategorySlug'])->name('catalog.category');

Route::get('/catalog/add_to_cart/{slug}', [CatalogPageController::class, 'addToCart'])->name('catalog.add_to_cart');

Route::get('/catalog/compare/{slug}', [CatalogPageController::class, 'compare'])->name('catalog.compare');

Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
Route::post('/feedbacks', [FeedbackController::class, 'sendMessage'])->name('feedbacks.send_message');

Route::get('/products/comparison', function () {})->name('comparison');

Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
Route::get('/users/{user}/viewed_products', [UserController::class, 'viewedProducts'])->name('users.viewed_products');

Route::get('sellers/{id}', [SellerController::class, 'show']);

Route::view('/about', 'about.main')->name('about');

Route::prefix('cart')->group(function (){

    Route::prefix('add')->group(function (){
        Route::get('/{product}/{seller}', [CartController::class, 'add'])->name('cart.addWithSeller');
        Route::get('/{product}', [CartController::class, 'add'])->name('cart.add');
    });

    Route::put('/{product}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

});
