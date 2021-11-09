<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Product;
use App\Orchid\Layouts\Discounts\AddDiscountFieldsLayout;
use App\Orchid\Layouts\Discounts\DiscountGroupsListener;
use App\Orchid\Layouts\Discounts\GroupsModalLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class DiscountFormScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;
    private bool $exist;

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
        $this->exist = $discount->exists;

        if ($this->exist) {
            $this->name = __('admin.discounts.edit');
        }

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
        return [
            ModalToggle::make(__('admin.discounts.groups.make'))
                ->modal('groupsModal')
                ->method('newGroup')
                ->icon('fullscreen'),
            Button::make(__('admin.discounts.save'))
                ->method('createOrUpdate')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::modal('groupsModal', [
                GroupsModalLayout::class
            ])->title(__('admin.discount.groups.new')),
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

    public function asyncGroups(int $count)
    {
        return ['groups' => $count];
    }

    public function newGroup()
    {
        $data = request()->except('_token');
        $group = DiscountGroup::create(['title' => $data['title']]);
        $group->products()->attach($data['grouppable']['products']);
        $group->products()->attach($data['grouppable']['categories']);
        Toast::success(__('admin.info.groups.added'));
    }

    public function createOrUpdate(Discount $discount)
    {
        $data = request()->except('_token');
        $discount->fill($data['discount']);
        $discount->save();
        Toast::success($this->exist ? __('admin.info.groups.updated') : __('admin.info.groups.added'));
        redirect()->route('platform.discounts');
    }

}
