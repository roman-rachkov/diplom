<?php

namespace App\Orchid\Screens\Order;

use Orchid\Screen\Screen;

class OrderListScreen extends Screen
{
    public $permission = 'platform.elements.orders';

    public function __construct()
    {
        $this->name = __('admin.orders.screen_name');
        $this->description = __('admin.orders.screen_description');
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [];
    }
}
