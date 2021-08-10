<?php

namespace App\Providers;

use App\Contracts\Repository\BannerRepositoryContract;
use App\Contracts\Repository\CategoryRepositoryContract;
use App\Contracts\Repository\DeliveryRepositoryContract;
use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Repository\FeedbackRepositoryContract;
use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\ProductRepositoryContract;
use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\DeliveryRepository;
use App\Repository\DiscountRepository;
use App\Repository\FeedbackRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->singleton(BannerRepositoryContract::class, BannerRepository::class);
        $this->app->singleton(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->singleton(DiscountRepositoryContract::class, DiscountRepository::class);
        $this->app->singleton(DeliveryRepositoryContract::class, DeliveryRepository::class);
        $this->app->singleton(FeedbackRepositoryContract::class, FeedbackRepository::class);
        $this->app->singleton(OrderRepositoryContract::class, OrderRepository::class);
        $this->app->singleton(ProductRepositoryContract::class, ProductRepository::class);


    }
}
