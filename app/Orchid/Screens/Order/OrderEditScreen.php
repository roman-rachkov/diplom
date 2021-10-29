<?php

namespace App\Orchid\Screens\Order;

use App\Models\Order;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class OrderEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = '';

    public function __construct()
    {
        $this->name = __('admin.orders.edit');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Order $order): array
    {
        $this->exists = $order->exists;

        return [
            'order' => $order
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [

            Button::make('Save')
                ->icon('note')
                ->method('update'),

        ];
    }

    /**
     * Views.
     *
     * @return array
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('order.full_name')
                    ->title(__('admin.orders.customer_name_title')),

                Input::make('order.email')
                    ->type('email')
                    ->title(__('Email')),

                Input::make('order.phone')
                    ->type('number')
                    ->title(__('admin.orders.customer_phone_title')),

                Input::make('order.delivery_type')
                    ->type('text')
                    ->title(__('admin.orders.order_delivery_type_title')),
            ]),
        ];
    }
}
