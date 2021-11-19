<?php

namespace App\Providers;

use App\Contracts\Repository\AdminSettingsRepositoryContract;
use App\Contracts\Repository\BannerRepositoryContract;
use App\Contracts\Repository\CategoryRepositoryContract;
use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Repository\CustomerRepositoryContract;
use App\Contracts\Repository\DeliveryRepositoryContract;
use App\Contracts\Repository\DiscountGroupRepositoryContract;
use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Repository\FeedbackRepositoryContract;
use App\Contracts\Repository\ImageRepositoryContract;
use App\Contracts\Repository\ManufacturerRepositoryContract;
use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Repository\OrderRepositoryContract;
use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\PaymentsServicesRepositoryContract;
use App\Contracts\Repository\PriceRepositoryContract;
use App\Contracts\Repository\ProductRepositoryContract;
use App\Contracts\Repository\ReviewRepositoryContract;
use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Repository\SellerRepositoryContract;
use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Repository\AdminSettingsRepository;
use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\CompareProductsRepository;
use App\Repository\CustomerRepository;
use App\Repository\DeliveryRepository;
use App\Repository\DiscountGroupRepository;
use App\Repository\DiscountRepository;
use App\Repository\FeedbackRepository;
use App\Repository\ImageRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use App\Repository\PaymentRepository;
use App\Repository\PriceRepository;
use App\Repository\PaymentsServicesRepository;
use App\Repository\ProductRepository;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use App\Repository\SellerRepository;
use App\Repository\ViewedProductsRepository;
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
        $this->app->singleton(BannerRepositoryContract::class, BannerRepository::class);
        $this->app->singleton(CategoryRepositoryContract::class, CategoryRepository::class);
        $this->app->singleton(DiscountRepositoryContract::class, DiscountRepository::class);
        $this->app->singleton(DeliveryRepositoryContract::class, DeliveryRepository::class);
        $this->app->singleton(FeedbackRepositoryContract::class, FeedbackRepository::class);
        $this->app->singleton(OrderRepositoryContract::class, OrderRepository::class);
        $this->app->singleton(ProductRepositoryContract::class, ProductRepository::class);
        $this->app->singleton(AdminSettingsRepositoryContract::class, AdminSettingsRepository::class);
        $this->app->singleton(ImageRepositoryContract::class, ImageRepository::class);
        $this->app->singleton(OrderItemRepositoryContract::class, OrderItemRepository::class);
        $this->app->singleton(PaymentRepositoryContract::class, PaymentRepository::class);
        $this->app->singleton(ViewedProductsRepositoryContract::class, ViewedProductsRepository::class);
        $this->app->singleton(ManufacturerRepositoryContract::class, ManufacturerRepository::class);
        $this->app->singleton(SellerRepositoryContract::class, SellerRepository::class);
        $this->app->singleton(UserRepositoryContract::class, UserRepository::class);
        $this->app->singleton(PaymentsServicesRepositoryContract::class, PaymentsServicesRepository::class);
        $this->app->singleton(PriceRepositoryContract::class, PriceRepository::class);
        $this->app->singleton(ReviewRepositoryContract::class, ReviewRepository::class);
        $this->app->singleton(CompareProductsRepositoryContract::class, CompareProductsRepository::class);
        $this->app->singleton(CustomerRepositoryContract::class, CustomerRepository::class);
        $this->app->singleton(DiscountGroupRepositoryContract::class, DiscountGroupRepository::class);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
