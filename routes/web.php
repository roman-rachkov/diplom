<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogPageController;
use App\Http\Controllers\CompareProductsController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewsController;
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

Route::get('/discounts', function () {
})->name('discounts.index');

Route::get('/products/{slug}', [ProductsController::class, 'show'])
    ->name('product.show');

Route::post('/products/{slug}/add_to_cart', [ProductsController::class, 'addToCart'])
    ->name('product.addToCart');

Route::post('/products/{slug}/add_to_comparison', [ProductsController::class, 'addToComparison'])
    ->name('product.addToComparison');

Route::post('/products/show_reviews/{product}', [ProductsController::class, 'showReviews'])
    ->name('product.showReviews');

Route::middleware('auth')->put('/reviews/{product}', [ReviewsController::class, 'store'])
    ->name('review.store');

Route::get('/catalog', [CatalogPageController::class, 'index'])
    ->name('catalog.index');

Route::get('/catalog/{slug}', [CatalogPageController::class, 'getProductForCatalogByCategorySlug'])->name('catalog.category');

Route::get('/catalog/add_to_cart/{product}', [CatalogPageController::class, 'addToCart'])->name('catalog.add_to_cart');

Route::get('/catalog/compare/{product}', [CatalogPageController::class, 'compare'])->name('catalog.compare');

Route::get('/feedbacks', [FeedbackController::class, 'index'])
    ->name('feedbacks.index');
Route::post('/feedbacks', [FeedbackController::class, 'sendMessage'])
    ->name('feedbacks.send_message');

Route::get('/comparison', [CompareProductsController::class, 'index'])->name('comparison');
Route::post('/comparison/remove_product/{productSlug}', [CompareProductsController::class, 'removeProduct'])
    ->name('comparison.remove_product');


Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');

Route::get('sellers/{id}', [SellerController::class, 'show']);

Route::view('/about', 'about.main')->name('about');

Route::prefix('/checkout')->group(function () {

    Route::prefix('/user')->group(function () {
        Route::get('/{email}', [OrderController::class, 'checkUserEmail'])->name('order.checkUser');
        Route::post('/', [OrderController::class, 'registerUser'])->name('order.registerUser');
    });
    Route::post('/confirm', [OrderController::class, 'confirm'])->name('order.confirm');
    Route::view('/confirm', 'cart.step-four')->name('order.confirm');
    Route::post('/', [OrderController::class, 'add'])->name('order.add');
    Route::get('/', [OrderController::class, 'index'])->name('order.index');

});

Route::prefix('cart')->group(function () {

    Route::prefix('add')->group(function () {
        Route::get('/{product}/{seller}', [CartController::class, 'add'])->name('cart.addWithSeller');
        Route::get('/{product}', [CartController::class, 'add'])->name('cart.add');
    });

    Route::put('/{product}', [CartController::class, 'update'])->name('cart.update');

    Route::delete('/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');

});

Route::prefix('payment')->group(function () {
    Route::post('/', [PaymentController::class, 'create'])->name('payment.create');
    Route::put('/complete', [PaymentController::class, 'complete'])->name('payment.complete');
    Route::put('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
});
