<?php

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [

            Menu::make(__('admin.banners.panel_name'))
                ->icon('layers')
                ->route('platform.banner.list')
                ->title(__('admin.menu.elements'))
                ->permission('platform.elements.banners'),

            Menu::make(__('admin.category.panel_name'))
                ->icon('list')
                ->route('platform.category.list')
                ->permission('platform.elements.category'),

            Menu::make(__('admin.sellers.panel_name'))
                ->icon('people')
                ->route('platform.sellers')
                ->permission('platform.elements.sellers'),

            Menu::make(__('admin.products.panel_name'))
                ->icon('basket-loaded')
                ->route('platform.products')
                ->permission('platform.elements.products'),

            Menu::make(__('admin.discounts.panel_name'))
                ->icon('present')
                ->route('platform.discounts')
                ->permission('platform.elements.discounts'),

            Menu::make(__('admin.orders.panel_name'))
                ->icon('money')
                ->route('platform.orders')
                ->permission('platform.elements.orders'),

            Menu::make(__('admin.discounts.list'))
                ->icon('present')
                ->route('platform.discounts')
                ->title(__('admin.discounts.panel_name'))
                ->permission('platform.elements.discounts'),
            Menu::make(__('admin.discounts.add_discount'))
                ->icon('plus')
                ->route('platform.discounts.add')
                ->permission('platform.elements.discounts'),

            Menu::make(__('admin.reviews.panel_name'))
                ->icon('note')
                ->route('platform.reviews')
                ->permission('platform.elements.reviews'),

            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),

            Menu::make(__('admin.settings.general'))
                ->icon('settings')
                ->route('platform.config')
                ->title(__('admin.settings.configuration'))
                ->permission('platform.systems.settings'),

            Menu::make(__('admin.import.panel_name'))
                ->icon('rocket')
                ->route('platform.import')
                ->permission('platform.systems.import'),

        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.import', __('admin.import.screen_name'))
                ->addPermission('platform.systems.settings', __('admin.settings.general')),
            ItemPermission::group(__('admin.banners.panel_name'))
                ->addPermission('platform.elements.banners', 'admin.banners.manage_banners'),
            ItemPermission::group(__('admin.menu.elements'))
                ->addPermission('platform.elements.category', 'admin.category.screen_name')
                ->addPermission('platform.elements.products', 'admin.products.screen_name')
                ->addPermission('platform.elements.sellers', 'admin.sellers.screen_name')
                ->addPermission('platform.elements.discounts', 'admin.discounts.screen_name')
                ->addPermission('platform.elements.orders', 'admin.orders.screen_name')
                ->addPermission('platform.elements.reviews', 'admin.reviews.screen_name'),
        ];
    }

    /**
     * @return string[]
     */
    public function registerSearchModels(): array
    {
        return [
            // ...Models
            // \App\Models\User::class
        ];
    }
}
