<?php

namespace App\Providers;

use App\Contracts\Service\Discount\CreateDiscountServiceContract;
use App\Service\Discount\CreateDiscountService;
use App\Contracts\Service\Discount\UpdateDiscountServiceContract;
use App\Service\Discount\UpdateDiscountService;

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
        $this->app->singleton(CreateDiscountServiceContract::class, CreateDiscountService::class);
        $this->app->singleton(UpdateDiscountServiceContract::class, UpdateDiscountService::class);
        
    }
}