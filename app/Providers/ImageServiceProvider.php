<?php

namespace App\Providers;

use App\Contracts\Image\CreateImageServiceContract;
use App\Service\Image\CreateImageService;
use App\Contracts\Image\UpdateImageServiceContract;
use App\Service\Image\UpdateImageService;
use App\Contracts\Image\DestroyImageServiceContract;
use App\Service\Image\DestroyImageService;

use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateImageServiceContract::class, CreateImageService::class);
        $this->app->singleton(UpdateImageServiceContract::class, UpdateImageService::class);
        $this->app->singleton(DestroyImageServiceContract::class, DestroyImageService::class);
        
    }
}