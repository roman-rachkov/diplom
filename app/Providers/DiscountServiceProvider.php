<?php

namespace App\Providers;

use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\Models\Discount;
use App\Service\Discount\MethodType\Classic;
use App\Service\Discount\MethodType\Fixed;
use App\Service\Discount\MethodType\MethodTypeFactory;
use App\Service\Discount\MethodType\Sum;
use App\Service\Discount\OtherDiscountService;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
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
        $this->app->singleton(OtherDiscountServiceContract::class, OtherDiscountService::class);
        $this->app->singleton(MethodTypeFactoryContract::class, MethodTypeFactory::class);
        $this->app->singleton(Discount::METHOD_FIXED, Fixed::class);
        $this->app->singleton(Discount::METHOD_CLASSIC, Classic::class);
        $this->app->singleton(Discount::METHOD_SUM, Sum::class);
    }
}
