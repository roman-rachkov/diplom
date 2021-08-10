<?php

namespace App\Providers;

use App\Contracts\Service\Review\CreateReviewServiceContract;
use App\Service\Review\CreateReviewService;
use App\Contracts\Service\Review\UpdateReviewServiceContract;
use App\Service\Review\UpdateReviewService;
use App\Contracts\Service\Review\DestroyReviewServiceContract;
use App\Service\Review\DestroyReviewService;

use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateReviewServiceContract::class, CreateReviewService::class);
        $this->app->singleton(UpdateReviewServiceContract::class, UpdateReviewService::class);
        $this->app->singleton(DestroyReviewServiceContract::class, DestroyReviewService::class);
        
    }
}