<?php

namespace App\Providers;

use App\Contracts\Service\Banner\CreateBannerServiceContract;
use App\Service\Banner\CreateBannerService;
use App\Contracts\Service\Banner\UpdateBannerServiceContract;
use App\Service\Banner\UpdateBannerService;
use App\Contracts\Service\Banner\DestroyBannerServiceContract;
use App\Service\Banner\DestroyBannerService;

use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateBannerServiceContract::class, CreateBannerService::class);
        $this->app->singleton(UpdateBannerServiceContract::class, UpdateBannerService::class);
        $this->app->singleton(DestroyBannerServiceContract::class, DestroyBannerService::class);
        
    }
}