<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogPageController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
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

Route::get('/discounts', function () {
})->name('discounts.index');

Route::post('/products/{slug}/add_to_cart', [ProductsController::class, 'addToCart'])
    ->name('product.addToCart');

Route::post('/products/{slug}/add_to_comparison', [ProductsController::class, 'addToComparison'])
    ->name('product.addToComparison');
Route::get('/catalog', [CatalogPageController::class, 'index'])->name('catalog.index');

Route::get('/catalog/{slug}', [CatalogPageController::class, 'getProductForCatalogByCategorySlug'])->name('catalog.category');

Route::get('/product/{slug}', [CatalogPageController::class, 'getByCategory'])->name('product.show');

Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
Route::post('/feedbacks', [FeedbackController::class, 'sendMessage'])->name('feedbacks.send_message');

Route::get('/products/comparison', function () {
})->name('comparison');

Route::get('/account', function () {
})->middleware('access:account')->name('account.show');

Route::get('sellers/{id}', [SellerController::class, 'show']);

Route::view('/about', 'about.main')->name('about');

Route::prefix('/checkout')->group(function () {

//    dd(app(\App\Contracts\Service\Cart\GetCartServiceContract::class)->getProductsQuantity());
    Route::prefix('/user')->group(function () {
        Route::get('/{email}', [OrderController::class, 'checkUserEmail'])->name('order.checkUser');
        Route::post('/', [OrderController::class, 'registerUser'])->name('order.registerUser');
    });
    Route::post('/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::view('/confirm', 'cart.step-four')->name('order.confirm');
    Route::post('/',[OrderController::class, 'add'])->name('order.add');
    Route::get('/', [OrderController::class, 'index'])->name('order.index');
//    Route::get('/', fn(\App\Contracts\Service\Cart\GetCartServiceContract $cartServiceContract)=>dd($cartServiceContract->getItemsList()))->name('order.index');
});

Route::prefix('cart')->group(function () {

    Route::get('/test', function (\App\Contracts\Service\Cart\GetCartServiceContract $getCart, \App\Contracts\Service\Cart\AddCartServiceContract $addCart) {
        $addCart->add(\App\Models\Product::has('prices')->inRandomOrder()->first(), rand(1, 10));
        dd($getCart->getProductsList());
    });

    Route::prefix('add')->group(function () {
        Route::get('/{product}/{seller}', [CartController::class, 'add'])->name('cart.addWithSeller');
        Route::get('/{product}', [CartController::class, 'add'])->name('cart.add');
    });

    Route::put('/{product}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

});
