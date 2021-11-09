<?php

namespace App\Orchid\Layouts\Discounts;

use App\Models\Discount;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\SimpleMDE;
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
        $discountMethods = [];
        Discount::getMethodTypes()->values()->each(function ($item) use (&$discountMethods) {
            $discountMethods[$item] = $item;
        });
        $discountCategories = [];
        Discount::getCategoryTypes()->values()->each(function ($item) use (&$discountCategories) {
            $discountCategories[$item] = $item;
        });
        return [
            Input::make('discount.value')
                ->type('number')
                ->placeholder(__('admin.discounts.value'))
//                ->value($query->discount->value)
                ->title(__('admin.discounts.value'))
                ->required(),
            Select::make('discount.method_type')
                ->options(collect($discountMethods))
                ->title(__('admin.discounts.method_type'))
                ->required(),
            Select::make('discount.category_type')
                ->title(__('admin.discounts.category_type'))
                ->options(collect($discountCategories))
                ->required(),
            Input::make('discount.weight')
                ->type('number')
                ->placeholder(__('admin.discounts.weight'))
                ->title(__('admin.discounts.weight'))
                ->value(0)
                ->required(),
            DateTimer::make('discount.start_at')
                ->placeholder(__('admin.discounts.start_at'))
                ->title(__('admin.discounts.start_at'))
                ->allowInput(),
            DateTimer::make('discount.end_at')
                ->placeholder(__('admin.discounts.end_at'))
                ->title(__('admin.discounts.end_at'))
                ->allowInput(),
            SimpleMDE::make('discount.description')
        ];
    }
}
