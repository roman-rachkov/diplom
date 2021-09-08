<?php

namespace App\Providers;

use App\Contracts\Service\AddToCartServiceContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\GetCartServiceContract;
use App\Contracts\Service\PayOrderServiceContract;
use App\Contracts\Service\AddReviewServiceContract;
use App\Contracts\Service\ImportSellerServiceContract;
use App\Contracts\Service\ViewedProductsServiceContract;
use App\Service\AddToCartService;
use App\Service\AdminSettingsService;
use App\Service\DeliveryCostService;
use App\Service\GetCartService;
use App\Service\PayOrderService;
use App\Service\AddReviewService;
use App\Service\ImportSellerService;
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
        $this->app->singleton(AddToCartServiceContract::class, AddToCartService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(PayOrderServiceContract::class, PayOrderService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImportSellerServiceContract::class, ImportSellerService::class);
        $this->app->singleton(AddReviewServiceContract::class, AddReviewService::class);

    }
}
