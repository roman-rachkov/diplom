<?php

namespace App\Orchid\Layouts\Discounts;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class DiscountsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'discounts';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', __('admin.discounts.id'))
                ->width(120),
            TD::make('value', __('admin.discounts.value'))
                ->width(120),
            TD::make('method_type', __('admin.discounts.method_type'))
                ->width(150),
            TD::make('category_type', __('admin.discounts.category_type'))
                ->width(150),
            TD::make('weight', __('admin.discounts.weight'))
                ->width(100),
            TD::make('start_at', __('admin.discounts.start_at'))
                ->width(200),
            TD::make('end_at', __('admin.discounts.end_at'))
                ->width(200),
            TD::make('is_active', __('admin.discounts.active'))
                ->render(function ($patient) {
                    return CheckBox::make('is_active')
                        ->checked((bool)$patient->is_active)
                        ->sendTrueOrFalse();
                }),
            TD::make('link', __('admin.discounts.controls'))
                ->render(function ($patient) {
                    return Link::make(__('admin.discounts.edit'))
                        ->icon('pencil')
                        ->route('platform.discounts.edit', $patient);
                })
        ];
    }
}
