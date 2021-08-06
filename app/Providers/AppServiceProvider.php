<?php

namespace App\Providers;

use App\Contracts\AddReviewServiceContract;
use App\Contracts\AddToCartServiceContract;
use App\Contracts\AdminSettingsServiceContract;
use App\Contracts\DeliveryCostServiceContract;
use App\Contracts\GetCartServiceContract;
use App\Contracts\ImportServiceContract;
use App\Contracts\OfferOfTheDayServiceContract;
use App\Contracts\PayServiceContract;
use App\Contracts\ViewedProductsServiceContract;
use App\Service\AddReviewService;
use App\Service\AddToCartService;
use App\Service\AdminSettingsService;
use App\Service\DeliveryCostService;
use App\Service\GetCartService;
use App\Service\ImportService;
use App\Service\OfferOfTheDayService;
use App\Service\PayService;
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
        $this->app->singleton(AddReviewServiceContract::class, AddReviewService::class);
        $this->app->singleton(AddToCartServiceContract::class, AddToCartService::class);
        $this->app->singleton(ViewedProductsServiceContract::class, ViewedProductsService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(PayServiceContract::class, PayService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImportServiceContract::class, ImportService::class);
    }
}
