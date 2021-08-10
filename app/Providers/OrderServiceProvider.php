<?php

namespace App\Providers;

use App\Contracts\Order\CreateOrderServiceContract;
use App\Service\Order\CreateOrderService;
use App\Contracts\Order\UpdateOrderServiceContract;
use App\Service\Order\UpdateOrderService;
use App\Contracts\Order\DestroyOrderServiceContract;
use App\Service\Order\DestroyOrderService;

use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateOrderServiceContract::class, CreateOrderService::class);
        $this->app->singleton(UpdateOrderServiceContract::class, UpdateOrderService::class);
        $this->app->singleton(DestroyOrderServiceContract::class, DestroyOrderService::class);
        
    }
}