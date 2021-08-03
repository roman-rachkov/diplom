<?php

namespace App\Providers;

use App\Contracts\AddReviewServiceContract;
use App\Contracts\AddToCartServiceContract;
use App\Contracts\AdminSettingsServiceContract;
use App\Contracts\CompareProductsServiceContract;
use App\Contracts\DeliveryCostServiceContract;
use App\Contracts\GetCartServiceContract;
use App\Contracts\ImportServiceContract;
use App\Contracts\OfferOfTheDayServiceContract;
use App\Contracts\PayServiceContract;
use App\Contracts\ProductDiscountServiceContract;
use App\Contracts\ProductsFiltersServiceContract;
use App\Contracts\ProductsSortServiceContract;
use App\Contracts\ViewedProductsServiceContract;
use App\Service\AddReviewService;
use App\Service\AddToCartService;
use App\Service\AdminSettingsService;
use App\Service\CompareProductsService;
use App\Service\DeliveryCostService;
use App\Service\GetCartService;
use App\Service\ImportService;
use App\Service\OfferOfTheDayService;
use App\Service\PayService;
use App\Service\ProductDiscountService;
use App\Service\ProductsFiltersService;
use App\Service\ProductsSortService;
use App\Service\ViewedProductsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(OfferOfTheDayServiceContract::class, OfferOfTheDayService::class);
        $this->app->singleton(ProductDiscountServiceContract::class, ProductDiscountService::class);
        $this->app->singleton(ProductsSortServiceContract::class, ProductsSortService::class);
        $this->app->singleton(ProductsFiltersServiceContract::class, ProductsFiltersService::class);
        $this->app->singleton(AddReviewServiceContract::class, AddReviewService::class);
        $this->app->singleton(AddToCartServiceContract::class, AddToCartService::class);
        $this->app->singleton(ViewedProductsServiceContract::class, ViewedProductsService::class);
        $this->app->singleton(CompareProductsServiceContract::class, CompareProductsService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(PayServiceContract::class, PayService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImportServiceContract::class, ImportService::class);

    }
}
