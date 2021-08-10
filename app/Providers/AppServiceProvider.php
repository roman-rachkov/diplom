<?php

namespace App\Providers;

use App\Contracts\Service\AddToCartServiceContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Delivery\UpdateDeliveryServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\Feedback\CreateFeedbackServiceContract;
use App\Contracts\Service\GetCartServiceContract;
use App\Contracts\Service\OfferOfTheDayServiceContract;
use App\Contracts\Service\Payment\CreatePaymentServiceContract;
use App\Contracts\Service\PayServiceContract;
use App\Contracts\Service\Seller\ImportSellerServiceContract;
use App\Contracts\Service\ViewedProduct\CreateViewedProductServiceContract;
use App\Contracts\Service\ViewedProductsServiceContract;
use App\Service\AddToCartService;
use App\Service\AdminSettingsService;
use App\Service\Delivery\UpdateDeliveryService;
use App\Service\DeliveryCostService;
use App\Service\Feedback\CreateFeedbackService;
use App\Service\GetCartService;
use App\Service\OfferOfTheDayService;
use App\Service\Payment\CreatePaymentService;
use App\Service\PayService;
use App\Service\Seller\ImportSellerService;
use App\Service\ViewedProduct\CreateViewedProductService;
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
        $this->app->singleton(AddToCartServiceContract::class, AddToCartService::class);
        $this->app->singleton(ViewedProductsServiceContract::class, ViewedProductsService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(PayServiceContract::class, PayService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);

        $this->app->singleton(ImportSellerServiceContract::class, ImportSellerService::class);
        $this->app->singleton(CreateFeedbackServiceContract::class, CreateFeedbackService::class);
        $this->app->singleton(CreatePaymentServiceContract::class, CreatePaymentService::class);
        $this->app->singleton(CreateViewedProductServiceContract::class, CreateViewedProductService::class);
        $this->app->singleton(UpdateDeliveryServiceContract::class, UpdateDeliveryService::class);
    }
}
