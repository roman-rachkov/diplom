<?php

namespace App\Orchid\Layouts\Discounts;

use App\Models\Discount;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class AddDiscountFieldsLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('discount.value')
                ->type('number')
                ->placeholder(__('admin.discounts.value'))
//                ->value($query->discount->value)
                ->title(__('admin.discounts.value'))
                ->required(),
            Select::make('discount.method_type')
                ->options(Discount::getMethodTypes())
                ->title(__('admin.discounts.method_type'))
                ->required(),
            Select::make('discount.category_type')
                ->title(__('admin.discounts.category_type'))
                ->options(Discount::getCategoryTypes())
                ->required(),
            Input::make('discount.weight')
                ->type('number')
                ->placeholder(__('admin.discounts.weight'))
                ->title(__('admin.discounts.weight'))
                ->required(),
            DateTimer::make('discount.start_at')
                ->placeholder(__('admin.discounts.start_at'))
                ->title(__('admin.discounts.start_at'))
                ->allowInput(),
            DateTimer::make('discount.end_at')
                ->placeholder(__('admin.discounts.end_at'))
                ->title(__('admin.discounts.end_at'))
                ->allowInput(),
        ];
    }
}
