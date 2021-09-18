<?php

use App\Http\Controllers\MainPageController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FeedbackController;
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

Route::get('/catalog', [CatalogPageController::class, 'index'])->name('catalog.index');

Route::get('/catalog/{slug}', [CatalogPageController::class, 'getProductForCatalogByCategorySlug'])->name('catalog.category');

Route::get('/product/{slug}', [CatalogPageController::class, 'getByCategory'])->name('product.show');

Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
Route::post('/feedbacks', [FeedbackController::class, 'sendMessage'])->name('feedbacks.send_message');

Route::get('/products/comparison', function () {})->name('comparison');

Route::get('/account', function () {
})->middleware('access:account')->name('account.show');

Route::get('sellers/{id}', [\App\Http\Controllers\SellerController::class, 'show']);

Route::view('/about', 'about.main')->name('about');

Route::prefix('cart')->group(function (){
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

    Route::delete('/{item}', [CartController::class, 'delete'])->name('cart.delete');

//    Route::get('/test', function (){
//        $cart = app(\App\Contracts\Service\CartServiceContract::class);
//
//        $cart->add(\App\Models\Price::find(10), 3);
//
//    });
});
