<?php

namespace App\Providers;

use App\Contracts\DeliveryCostServiceContract;
use App\Contracts\Manufacturer\CreateManufacturerServiceContract;
use App\Contracts\Manufacturer\UpdateManufacturerServiceContract;
use App\Service\Manufacturer\CreateManufacturerService;
use App\Service\Manufacturer\DestroyManufacturerService;
use App\Service\Manufacturer\UpdateManufacturerService;
use Illuminate\Support\ServiceProvider;

class ManufacturerServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateManufacturerServiceContract::class, CreateManufacturerService::class);
        $this->app->singleton(UpdateManufacturerServiceContract::class, UpdateManufacturerService::class);
        $this->app->singleton(DeliveryCostServiceContract::class, DestroyManufacturerService::class);
    }
}
