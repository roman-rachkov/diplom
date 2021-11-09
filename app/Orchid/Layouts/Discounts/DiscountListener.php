<?php

namespace App\Orchid\Layouts\Discounts;

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
        'discount.category_type'
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
    protected $asyncMethod = 'asyncChangeCategory';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        $accordion = [];
        return [
            Layout::columns([
                AddDiscountFieldsLayout::class,
                Layout::accordion([
                    __('admin.discounts.category.product') => [
//                        Layout::rows([
                        DiscountGroupsListener::class
//                        ])
                    ],
                    //Cart
                    __('admin.discounts.category.cart.title') => [
                        Layout::rows([
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
                        ])
                    ],

                ]),
            ])
        ];
    }
}
