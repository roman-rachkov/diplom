<?php

namespace App\Providers;

use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Service\Discount\MethodType\MethodTypeFactory;
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
        $this->app->singleton(MethodTypeFactoryContract::class, MethodTypeFactory::class);
    }
}
