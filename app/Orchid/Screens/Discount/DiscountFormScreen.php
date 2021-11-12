<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Orchid\Layouts\Discounts\AddDiscountFieldsLayout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class DiscountFormScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;

    public function __construct()
    {
        $this->name = __('admin.discounts.add_discount');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Discount $discount): array
    {
        return [
            'discount' => $discount
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::columns([
                AddDiscountFieldsLayout::class,
                Layout::accordion([
                    __('admin.discounts.category.product') => [
                        Layout::rows([
                            Relation::make('discount.products')
                                ->title(__('admin.products.panel_name'))
                                ->fromModel(Product::class, 'name')
                                ->multiple(),
                            Relation::make('discount.categories')
                                ->title(__('admin.category.panel_name'))
                                ->fromModel(Category::class, 'name')
                                ->multiple(),
                        ])
                    ],
                    __('admin.discounts.category.groups.title') => [
                        Layout::accordion([
                            __('admin.discounts.category.groups.a') => [
                                Layout::rows([
                                    Relation::make('discount.products')
                                        ->title(__('admin.products.panel_name'))
                                        ->fromModel(Product::class, 'name')
                                        ->multiple(),
                                    Relation::make('discount.categories')
                                        ->title(__('admin.category.panel_name'))
                                        ->fromModel(Category::class, 'name')
                                        ->multiple(),
                                ])
                            ],
                            __('admin.discounts.category.groups.b') => [
                                Layout::rows([
                                    Relation::make('discount.products')
                                        ->title(__('admin.products.panel_name'))
                                        ->fromModel(Product::class, 'name')
                                        ->multiple(),
                                    Relation::make('discount.categories')
                                        ->title(__('admin.category.panel_name'))
                                        ->fromModel(Category::class, 'name')
                                        ->multiple(),
                                ])
                            ]
                        ])
                    ],
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
                                ->placeholder(__('admin.discounts.maximum_qty'))
                                ->title(__('admin.discounts.maximum_cost')),
                            Input::make('discount.maximum_qty')
                                ->type('number')
                                ->placeholder(__('admin.discounts.maximum_qty'))
                                ->title(__('admin.discounts.maximum_cost')),
                        ])
                    ],

                ]),
            ])
        ];
    }
}
