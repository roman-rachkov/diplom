<?php

namespace App\Providers;

use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Contracts\Service\Product\CreateProductServiceContract;
use App\Contracts\Service\Product\DestroyProductServiceContract;
use App\Contracts\Service\Product\ImportProductServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Contracts\Service\Product\ProductsFiltersServiceContract;
use App\Contracts\Service\Product\ProductsSortServiceContract;
use App\Contracts\Service\Product\UpdateProductServiceContract;
use App\Service\Product\CompareProductsService;
use App\Service\Product\CreateProductService;
use App\Service\Product\DestroyProductService;
use App\Service\Product\ImportProductService;
use App\Service\Product\ProductDiscountService;
use App\Service\Product\ProductsFiltersService;
use App\Service\Product\ProductsSortService;
use App\Service\Product\UpdateProductService;
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
        $this->app->singleton(ProductDiscountServiceContract::class, ProductDiscountService::class);
        $this->app->singleton(ProductsSortServiceContract::class, ProductsSortService::class);
        $this->app->singleton(ProductsFiltersServiceContract::class, ProductsFiltersService::class);
        $this->app->singleton(CompareProductsServiceContract::class, CompareProductsService::class);
        $this->app->singleton(ImportProductServiceContract::class, ImportProductService::class);


        $this->app->singleton(CreateProductServiceContract::class, CreateProductService::class);
        $this->app->singleton(UpdateProductServiceContract::class, UpdateProductService::class);
        $this->app->singleton(DestroyProductServiceContract::class, DestroyProductService::class);
    }
}
