<?php

namespace App\Providers;

use App\Contracts\Repository\UserRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Cart\AddCartServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\Cart\RemoveCartServiceContract;
use App\Contracts\Service\DeliveryCostServiceContract;
use App\Contracts\Service\PayOrderServiceContract;
use App\Contracts\Service\AddReviewServiceContract;
use App\Contracts\Service\ImportSellerServiceContract;
use App\Contracts\Service\Product\ProductDiscountServiceContract;
use App\Models\Customer;
use App\Repository\UserRepository;
use App\Service\AdminSettingsService;
use App\Service\Cart\AddCartService;
use App\Service\Cart\GetCartService;
use App\Service\Cart\RemoveCartService;
use App\Service\DeliveryCostService;
use App\Service\PayOrderService;
use App\Service\AddReviewService;
use App\Service\ImportSellerService;
use App\Service\Product\ProductDiscountService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        $this->app->singleton(DeliveryCostServiceContract::class, DeliveryCostService::class);
        $this->app->singleton(PayOrderServiceContract::class, PayOrderService::class);
        $this->app->singleton(AdminSettingsServiceContract::class, AdminSettingsService::class);
        $this->app->singleton(ImportSellerServiceContract::class, ImportSellerService::class);
        $this->app->singleton(AddReviewServiceContract::class, AddReviewService::class);
        $this->app->singleton(ProductDiscountServiceContract::class, ProductDiscountService::class);
        $this->app->singleton(AddCartServiceContract::class, AddCartService::class);
        $this->app->singleton(GetCartServiceContract::class, GetCartService::class);
        $this->app->singleton(RemoveCartServiceContract::class, RemoveCartService::class);
        $this->app->singleton(UserRepositoryContract::class, UserRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path('routes/breadcrumbs.php');

        $this->app->singleton(Customer::class, function () {
            $customer = Customer::firstOrNew(['hash' => session('customer_token')]);;
            if ($customer->hash === null) {
                $customer->hash = hash('sha256', $customer);
                session(['customer_token' => $customer->hash]);
            }
            $customer->save();
            return $customer;
        });

        Blade::directive('settings', function ($expression) {
            eval("\$params = [$expression];");
            list($key, $default) = $params;
            return "<?php echo app(\App\Contracts\Service\AdminSettingsServiceContract::class)->get('$key', $default); ?>";
        });
    }
}
