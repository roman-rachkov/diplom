<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Order;
use App\Orchid\Filters\DeliveryTypeFilter;
use App\Orchid\Layouts\DeliveryTypeSelection;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->width('150')
                ->render(function (Order $order) {
                    return "<span class='small text-muted mt-1 mb-0'># {$order->id}</span>";
                }),
            TD::make('full_name', __('admin.orders.customer_name_title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Order $order) {
                    return Link::make($order->full_name)
                        ->route('platform.orders.edit', $order);
                }),

            TD::make('phone', __('admin.orders.customer_phone_title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Order $order) {
                    return $order->phone;
                }),

            TD::make('email', __('Email'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Order $order) {
                    return $order->email;
                }),

            TD::make('delivery_type', __('admin.orders.order_delivery_type_title'))
                ->sort()
                ->render(function (Order $order) {
                    return __('admin.orders.delivery_type.' . $order->delivery_type);
                }),

            TD::make('total', __('admin.orders.order_total_title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Order $order) {
                    return $order->total;
                }),

            TD::make('created_at', __('Created'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Order $order) {
                    return $order->created_at;
                }),
        ];
    }
}
