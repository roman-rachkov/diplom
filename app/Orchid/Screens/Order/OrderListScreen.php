<?php

namespace App\Orchid\Screens\Order;

use App\Models\Order;
use App\Orchid\Filters\DeliveryTypeFilter;
use App\Orchid\Layouts\DeliveryTypeSelection;
use App\Orchid\Layouts\Order\OrderListLayout;
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
        return [
            'orders' => Order::filtersApply([DeliveryTypeFilter::class])->filters()->defaultSort('id')->paginate()
        ];
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
     * @return array
     */
    public function layout(): array
    {
        return [
            DeliveryTypeSelection::class,
            OrderListLayout::class
        ];
    }
}
