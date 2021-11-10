<?php

namespace App\Providers;

use App\Actions\CreateNewUserWithPhone;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\FlashMessageServiceContract;
use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Contracts\Service\AddReviewServiceContract;
use App\Contracts\Service\ImportSellerServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Contracts\Service\SellerServiceContract;
use App\Contracts\Service\UsersAvatarServiceContract;
use App\Models\Customer;
use App\Orchid\Layouts\Discounts\GroupsLayout;
use App\Service\AdminSettingsService;
use App\Service\Cart\AddCartService;
use App\Service\Cart\GetCartService;
use App\Service\Cart\RemoveCartService;
use App\Service\CustomerService;
use App\Service\DeliveryCostService;
use App\Service\FlashMessageService;
use App\Service\Payment\PaymentsIntegratorService;
use App\Service\AddReviewService;
use App\Service\ImportSellerService;
use App\Service\Product\ProductDiscountService;
use App\Service\Product\ViewedProductsService;
use App\Service\SellerService;
use App\Service\UsersAvatarService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Orchid\Screen\Layout;
use Orchid\Screen\LayoutFactory;
use Orchid\Screen\Repository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Factory::guessFactoryNamesUsing(function ($class) {
            return 'Database\\Factories\\' . class_basename($class) . 'Factory';
        });

        $this->app->singleton(CreatesNewUsers::class, CreateNewUserWithPhone::class);
        $this->app->singleton(UsersAvatarServiceContract::class, UsersAvatarService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImportSellerServiceContract::class, ImportSellerService::class);
        $this->app->singleton(AddReviewServiceContract::class, AddReviewService::class);
        $this->app->singleton(ProductDiscountServiceContract::class, ProductDiscountService::class);
        $this->app->singleton(FlashMessageServiceContract::class, FlashMessageService::class);
        $this->app->singleton(AddCartServiceContract::class, AddCartService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(RemoveCartServiceContract::class, RemoveCartService::class);
        $this->app->singleton(FlashMessageServiceContract::class, FlashMessageService::class);
        $this->app->singleton(PaymentsIntegratorServiceContract::class, PaymentsIntegratorService::class);
        $this->app->singleton(CustomerServiceContract::class, CustomerService::class);
        $this->app->singleton(ViewedProductsServiceContract::class, ViewedProductsService::class);
        $this->app->singleton(CustomerServiceContract::class, CustomerService::class);
        $this->app->singleton(SellerServiceContract::class, SellerService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('routes/breadcrumbs.php');

        Blade::directive('settings', function ($expression) {
            list($key, $default) = explode(',', $expression);
            $key = trim($key, ' \'');
            $default = trim($default, ' \'');
            return "<?php echo app(\App\Contracts\Service\AdminSettingsServiceContract::class)->get('$key', $default); ?>";
        });


    }
}
