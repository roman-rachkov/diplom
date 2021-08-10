<?php

namespace App\Providers;

use App\Contracts\Service\User\CreateUserServiceContract;
use App\Contracts\Service\User\DestroyUserServiceContract;
use App\Contracts\Service\User\UpdateUserServiceContract;
use App\Service\User\CreateUserService;
use App\Service\User\DestroyUserService;
use App\Service\User\UpdateUserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
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
        $this->app->singleton(CreateUserServiceContract::class, CreateUserService::class);
        $this->app->singleton(UpdateUserServiceContract::class, UpdateUserService::class);
        $this->app->singleton(DestroyUserServiceContract::class, DestroyUserService::class);
    }
}
