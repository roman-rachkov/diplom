<?php

namespace App\Orchid\Layouts\Discounts;

use App\Models\Discount;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
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
            Input::make('discount.id')->type('hidden'),
            Input::make('discount.title')
                ->type('text')
                ->title(__('admin.discounts.title'))
                ->required(),
            Input::make('discount.value')
                ->type('number')
                ->placeholder(__('admin.discounts.value'))
                ->title(__('admin.discounts.value'))
                ->required(),
            Select::make('discount.method_type')
                ->options(collect($discountMethods))
                ->title(__('admin.discounts.method_type'))
                ->value($this->query['discount.method_type'])
                ->required(),
            Select::make('discount.category_type')
                ->title(__('admin.discounts.category_type'))
                ->value($this->query['discount.category_type'])
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
            CheckBox::make('discount.is_active')
                ->title(__('admin.discounts.active'))
//                ->checked((bool)$patient->is_active)
                ->sendTrueOrFalse(),
            SimpleMDE::make('discount.description'),
            Picture::make('discount.image_id')
                ->title(__('admin.discounts.image'))
                ->targetId()
        ];
    }
}
