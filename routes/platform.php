<?php

declare(strict_types=1);

use App\Orchid\Screens\Banner\BannerEditScreen;
use App\Orchid\Screens\Banner\BannerListScreen;
use App\Orchid\Screens\Category\CategoryEditScreen;
use App\Orchid\Screens\Category\CategoryListScreen;
use App\Orchid\Screens\Discount\DiscountListScreen;
use App\Orchid\Screens\Order\OrderEditScreen;
use App\Orchid\Screens\Order\OrderListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Product\ProductEditScreen;
use App\Orchid\Screens\Product\ProductListScreen;
use App\Orchid\Screens\Review\ReviewListScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\Seller\SellerListScreen;
use App\Orchid\Screens\Seller\SellerEditScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit');

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

// Platform > System > Roles > Role
Route::screen('roles/{roles}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });


// Platform > Config
Route::screen('config', \App\Orchid\Screens\ConfigurationScreen::class)
    ->name('platform.config')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.settings.Name'));
    });

Route::screen('import', \App\Orchid\Screens\Import\ImportMainScreen::class)
    ->name('platform.import')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.import.panel_name'));
    });

// Platform > Banners
Route::screen('banner/{banner?}', BannerEditScreen::class)
    ->name('platform.banner.edit')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.banner.list')
            ->push(__('admin.banners.edit_banner'));
    });
Route::screen('banners', BannerListScreen::class)
    ->name('platform.banner.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.banners.panel_name'), route('platform.banner.list'));
    });

//Platform > Category
Route::screen('category/add', CategoryEditScreen::class)
    ->name('platform.category.add')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.category.edit'));
    });

Route::screen('category', CategoryListScreen::class)
    ->name('platform.category.list')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.category.panel_name'));
    });

Route::screen('category/{category?}', CategoryEditScreen::class)
    ->name('platform.category.edit')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.category.list')
            ->push(__('admin.category.edit'));
    });

//Platform > Product
Route::screen('product/add', ProductEditScreen::class)
    ->name('platform.products.add')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.products.add'));
    });

Route::screen('product', ProductListScreen::class)
    ->name('platform.products')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.products.panel_name'));
    });

Route::screen('product/{product?}', ProductEditScreen::class)
    ->name('platform.products.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.products.edit'));
    });


//Platform > Sellers
Route::screen('sellers', SellerListScreen::class)
    ->name('platform.sellers')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.sellers.panel_name'));
    });

Route::screen('sellers/add', SellerEditScreen::class)
    ->name('platform.sellers.add')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.sellers.add'));
    });

Route::screen('sellers/{seller?}', SellerEditScreen::class)
    ->name('platform.sellers.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.sellers')
            ->push(__('admin.sellers.edit'));
    });


//Platform > Discounts
Route::screen('discounts', DiscountListScreen::class)
    ->name('platform.discounts')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.discounts.panel_name'));
    });
Route::screen('discounts/add', \App\Orchid\Screens\Discount\DiscountFormScreen::class)
    ->name('platform.discounts.add')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.discounts.panel_name'));
    });
Route::screen('discounts/edit/{discount}', \App\Orchid\Screens\Discount\DiscountFormScreen::class)
    ->name('platform.discounts.edit')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.discounts.panel_name'));
    });


//Platform > orders
Route::screen('orders', OrderListScreen::class)
    ->name('platform.orders')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('admin.orders.panel_name'));
    });

Route::screen('orders/{order?}', OrderEditScreen::class)
    ->name('platform.orders.edit')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.orders')
            ->push(__('admin.orders.edit'));
    });

//Platform > review
Route::screen('reviews', ReviewListScreen::class)
    ->name('platform.reviews')
    ->breadcrumbs(function (Trail $trail){
        return $trail
            ->parent('platform.index')
            ->push(__('admin.reviews.panel_name'));
    });
