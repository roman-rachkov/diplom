<?php

namespace App\Providers;

use App\Contracts\Service\Image\CreateImageServiceContract;
use App\Service\Image\CreateImageService;
use App\Contracts\Service\Image\UpdateImageServiceContract;
use App\Service\Image\UpdateImageService;

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
        
    }
}