<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;

class DeliveryTypeFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['delivery_type'];

    /**
     * @return string
     */
    public function name(): string
    {
        return __('admin.orders.order_delivery_type_title');
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('delivery_type', $this->request->get('delivery_type'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return
            [
                Select::make('delivery_type')
                    ->options(
                        [
                            'default' => __('admin.orders.delivery_type.default'),
                            'express' => __('admin.orders.delivery_type.express')
                        ]
                    )
                    ->title(__('admin.orders.order_delivery_type_title'))
                    ->empty()
                    ->value(__('admin.orders.delivery_type.' . $this->request->get('delivery_type')))
            ];
    }
}
