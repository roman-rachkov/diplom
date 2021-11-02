<?php

namespace App\Orchid\Screens\Order;

use App\Models\Order;
use App\Rules\PhoneRule;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
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
            'order' => $order,
            'delivery_types' => Order::get()->unique('delivery_type')->toArray()
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
                    ->title(__('admin.orders.customer_name_title'))
                    ->required(),

                Input::make('order.email')
                    ->type('email')
                    ->title(__('Email'))
                    ->required(),

                Input::make('order.phone')
                    ->type('tel')
                    ->title(__('admin.orders.customer_phone_title'))
                    ->required(),

                Input::make('order.city')
                    ->title(__('admin.orders.delivery_city'))
                    ->vertical()
                    ->required(),

                Group::make([
                    Input::make('order.address')
                        ->title(__('admin.orders.delivery_address'))
                        ->required(),
                    Select::make('order.delivery_type')
                        ->title(__('admin.orders.order_delivery_type_title'))
                        ->options([
                            'default' => __('admin.orders.delivery_type.default'),
                            'express' => __('admin.orders.delivery_type.express')
                        ])
                        ->value('order.delivery_type')
                        ->required(),

                ])->fullWidth(),
                Group::make([
                    Input::make('order.total')
                        ->type('text')
                        ->title(__('admin.orders.order_total_title'))
                        ->required(),
                ])->autoWidth(),

                TextArea::make('order.comment')
                    ->title(__('admin.orders.comment_title'))
                    ->rows(3)
            ]),
        ];
    }
    /**
     * @param Order $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Order $order, Request $request)
    {
        $request->validate([
            'order.full_name' => 'required|min:10|max:100',
            'order.email' => 'required|email:rfc,dns',
            'order.phone' => ['required', new PhoneRule],
            'order.delivery_type' => 'required',
            'order.city' => 'required',
            'order.address' => 'required',
            'order.total' => 'required|numeric|gt:0',
            'order.comment' => ''
        ]);

        $order->fill($request->post('order'))->save();

        Alert::info(__('admin.orders.success_info'));
        return redirect()->route('platform.orders');
    }
}
