<?php

namespace App\Providers;

use App\Contracts\Repository\BannerRepositoryContract;
use App\Contracts\Repository\CategoryRepositoryContract;
use App\Contracts\Repository\DeliveryRepositoryContract;
use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Repository\FeedbackRepositoryContract;
use App\Contracts\Repository\ImageRepositoryContract;
use App\Contracts\Repository\ManufacturerRepositoryContract;
use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\DeliveryRepository;
use App\Repository\DiscountRepository;
use App\Repository\FeedbackRepository;
use App\Repository\ImageRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\PaymentRepository;
use App\Repository\ProductRepository;
use App\Repository\ViewedProductsRepository;
use App\Service\AdminSettingsService;
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
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImageRepositoryContract::class, ImageRepository::class);
        $this->app->singleton(OrderItemRepositoryContract::class, OrderItemRepository::class);
        $this->app->singleton(PaymentRepositoryContract::class, PaymentRepository::class);
        $this->app->singleton(ViewedProductsRepositoryContract::class, ViewedProductsRepository::class);
        $this->app->singleton(ManufacturerRepositoryContract::class, ManufacturerRepository::class);
    }
}
