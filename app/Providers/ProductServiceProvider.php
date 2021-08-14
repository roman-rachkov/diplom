<?php

namespace App\Providers;

use App\Contracts\Service\Product\OfferOfTheDayServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\ImportProductServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Contracts\Service\Product\ProductsFiltersServiceContract;
use App\Contracts\Service\Product\ProductsSortServiceContract;

use App\Service\Product\OfferOfTheDayService;
use App\Service\Product\CompareProductsService;
use App\Service\Product\ImportProductService;
use App\Service\Product\ProductDiscountService;
use App\Service\Product\ProductsFiltersService;
use App\Service\Product\ProductsSortService;
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
        $this->app->singleton(ProductsSortServiceContract::class, ProductsSortService::class);
        $this->app->singleton(ProductsFiltersServiceContract::class, ProductsFiltersService::class);
        $this->app->singleton(CompareProductsServiceContract::class, CompareProductsService::class);
        $this->app->singleton(ImportProductServiceContract::class, ImportProductService::class);
    }
}
