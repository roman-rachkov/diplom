<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;

class PermissionServiceProvider extends ServiceProvider
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
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard)
    {
        $permissions = ItemPermission::group('Account')
            ->addPermission('account', 'Access to authenticated user account/profile on frontend');

        $dashboard->registerPermissions($permissions);
    }
}
