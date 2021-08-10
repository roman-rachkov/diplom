<?php

namespace App\Providers;

use App\Contracts\Service\OrderItem\CreateOrderItemServiceContract;
use App\Service\OrderItem\CreateOrderItemService;
use App\Contracts\Service\OrderItem\UpdateOrderItemServiceContract;
use App\Service\OrderItem\UpdateOrderItemService;
use App\Contracts\Service\OrderItem\DestroyOrderItemServiceContract;
use App\Service\OrderItem\DestroyOrderItemService;

use Illuminate\Support\ServiceProvider;

class OrderItemServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateOrderItemServiceContract::class, CreateOrderItemService::class);
        $this->app->singleton(UpdateOrderItemServiceContract::class, UpdateOrderItemService::class);
        $this->app->singleton(DestroyOrderItemServiceContract::class, DestroyOrderItemService::class);
        
    }
}