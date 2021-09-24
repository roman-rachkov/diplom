<?php

namespace App\Providers;

use App\Contracts\Service\AddToCartServiceContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\FlashMessageServiceContract;
use App\Contracts\Service\GetCartServiceContract;
use App\Contracts\Service\PayOrderServiceContract;
use App\Contracts\Service\AddReviewServiceContract;
use App\Contracts\Service\ImportSellerServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Service\AddToCartService;
use App\Service\AdminSettingsService;
use App\Service\DeliveryCostService;
use App\Service\FlashMessageService;
use App\Service\GetCartService;
use App\Service\PayOrderService;
use App\Service\AddReviewService;
use App\Service\ImportSellerService;
use App\Service\Product\ProductDiscountService;
use Illuminate\Database\Eloquent\Factories\Factory;
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
        Factory::guessFactoryNamesUsing(function ($class) {
            return 'Database\\Factories\\' . class_basename($class) . 'Factory';
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('routes/breadcrumbs.php');

        $this->app->singleton(AddToCartServiceContract::class, AddToCartService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(PayOrderServiceContract::class, PayOrderService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImportSellerServiceContract::class, ImportSellerService::class);
        $this->app->singleton(AddReviewServiceContract::class, AddReviewService::class);
        $this->app->singleton(ProductDiscountServiceContract::class, ProductDiscountService::class);
        $this->app->singleton(FlashMessageServiceContract::class, FlashMessageService::class);
    }
}
