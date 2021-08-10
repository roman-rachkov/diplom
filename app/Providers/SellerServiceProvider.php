<?php

namespace App\Providers;

use App\Contracts\Seller\CreateSellerServiceContract;
use App\Contracts\Seller\DestroySellerServiceContract;
use App\Contracts\Seller\ImportSellerServiceContract;
use App\Contracts\User\UpdateUserServiceContract;
use App\Service\Seller\CreateSellerService;
use App\Service\Seller\DestroySellerService;
use App\Service\Seller\ImportSellerService;
use App\Service\Seller\UpdateSellerService;
use Illuminate\Support\ServiceProvider;

class SellerServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateSellerServiceContract::class, CreateSellerService::class);
        $this->app->singleton(UpdateUserServiceContract::class, UpdateSellerService::class);
        $this->app->singleton(DestroySellerServiceContract::class, DestroySellerService::class);
        $this->app->singleton(ImportSellerServiceContract::class, ImportSellerService::class);
    }
}
