<?php

namespace App\Providers;

use App\Contracts\Service\Category\CreateCategoryServiceContract;
use App\Service\Category\CreateCategoryService;
use App\Contracts\Service\Category\UpdateCategoryServiceContract;
use App\Service\Category\UpdateCategoryService;
use App\Contracts\Service\Category\DestroyCategoryServiceContract;
use App\Service\Category\DestroyCategoryService;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateCategoryServiceContract::class, CreateCategoryService::class);
        $this->app->singleton(UpdateCategoryServiceContract::class, UpdateCategoryService::class);
        $this->app->singleton(DestroyCategoryServiceContract::class, DestroyCategoryService::class);
        
    }
}