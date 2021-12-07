<?php

namespace App\Providers;

use App\Contracts\Service\Product\OfferOfTheDayServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;

use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Service\Product\OfferOfTheDayService;
use App\Service\Product\CompareProductsService;
use App\Service\Product\ProductDiscountService;
use App\Service\Product\ViewedProductsService;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(OfferOfTheDayServiceContract::class, OfferOfTheDayService::class);
        $this->app->singleton(ProductDiscountServiceContract::class, ProductDiscountService::class);
        $this->app->singleton(CompareProductsServiceContract::class, CompareProductsService::class);
        $this->app->singleton(ViewedProductsServiceContract::class, ViewedProductsService::class);

    }
}
