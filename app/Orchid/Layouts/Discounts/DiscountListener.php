<?php

namespace App\Orchid\Layouts\Discounts;

use App\Models\Discount;
use App\Models\DiscountGroup;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;

class DiscountListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'discount.id',
        'discount.discountGroups.count',
        'discount.category_type',
        'discount.value',
        'discount.method_type',
        'discount.weight',
        'discount.start_at',
        'discount.end_at',
        'discount.description',
    ];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncFields';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
//        $accordion = [];
//        if ($this->query['discount.category_type'] === Discount::CATEGORY_OTHER) {
//            $accordion[__('admin.discounts.category.product')] = GroupsModalLayout::class;
//        }
//        if ($this->query['discount.category_type'] === Discount::CATEGORY_SET) {
//            $accordion[__('admin.discounts.category.product')] = DiscountGroupsListener::class;
//        }
//        if ($this->query['discount.category_type'] === Discount::CATEGORY_CART) {
//            $accordion[__('admin.discounts.category.cart.title')] = Layout::rows([
//                Input::make('discount.minimal_cost')
//                    ->type('number')
//                    ->placeholder(__('admin.discounts.minimal_cost'))
//                    ->title(__('admin.discounts.minimal_cost')),
//                Input::make('discount.maximum_cost')
//                    ->type('number')
//                    ->placeholder(__('admin.discounts.maximum_cost'))
//                    ->title(__('admin.discounts.maximum_cost')),
//                Input::make('discount.minimum_qty')
//                    ->type('number')
//                    ->placeholder(__('admin.discounts.minimal_qty'))
//                    ->title(__('admin.discounts.minimal_qty')),
//                Input::make('discount.maximum_qty')
//                    ->type('number')
//                    ->placeholder(__('admin.discounts.maximum_qty'))
//                    ->title(__('admin.discounts.maximum_qty')),
//            ]);
//        }
        dump($this->query);
        if ($this->query['discount.category_type'] === Discount::CATEGORY_OTHER) {
            $layout = GroupsLayout::class;
        }
        if ($this->query['discount.category_type'] === Discount::CATEGORY_SET) {
            $layout = DiscountGroupsListener::class;
        }
        if ($this->query['discount.category_type'] === Discount::CATEGORY_CART) {
            $layout = Layout::rows([
                Input::make('discount.minimal_cost')
                    ->type('number')
                    ->placeholder(__('admin.discounts.minimal_cost'))
                    ->title(__('admin.discounts.minimal_cost')),
                Input::make('discount.maximum_cost')
                    ->type('number')
                    ->placeholder(__('admin.discounts.maximum_cost'))
                    ->title(__('admin.discounts.maximum_cost')),
                Input::make('discount.minimum_qty')
                    ->type('number')
                    ->placeholder(__('admin.discounts.minimal_qty'))
                    ->title(__('admin.discounts.minimal_qty')),
                Input::make('discount.maximum_qty')
                    ->type('number')
                    ->placeholder(__('admin.discounts.maximum_qty'))
                    ->title(__('admin.discounts.maximum_qty')),
            ]);
        }

        return [
            Layout::columns(
                [
                    AddDiscountFieldsLayout::class,
                    $layout,
                ]
            )
        ];
    }
}
