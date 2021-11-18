<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Category;
use App\Models\Discount;
use App\Models\DiscountGroup;
use App\Models\Product;
use App\Orchid\Layouts\Discounts\AddDiscountFieldsLayout;
use App\Orchid\Layouts\Discounts\DiscountGroupsListener;
use App\Orchid\Layouts\Discounts\DiscountListener;
use App\Orchid\Layouts\Discounts\GroupsLayout;
use Illuminate\Support\Arr;
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

        $this->discount = $discount;
        $this->discount->load(['discountGroups.products', 'discountGroups.categories']);
        $this->discount->discountGroups['count'] = $this->discount->discountGroups()->count();
        return [
            'discount' => $this->discount
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
            DiscountListener::class
        ];
    }

    public function asyncFields(array $args)
    {
        $discount = Discount::findOrNew($args['id']);
        $discount->fill($args);
        $discount->load(['discountGroups.products', 'discountGroups.categories']);
        $discount->discountGroups['count'] = Arr::get($args, 'discountGroups.count') ?? $discount->discountGroups()->count();
        return [
            'discount' => $discount
        ];
    }

//    public function newGroup()
//    {
//        $data = request()->except('_token');
//        $group = DiscountGroup::create(['title' => $data['title']]);
//        $group->products()->attach($data['grouppable']['products']);
//        $group->products()->attach($data['grouppable']['categories']);
//        Toast::success(__('admin.info.groups.added'));
//    }
//
    public function createOrUpdate()
    {
        dd(request()->except('_token'));
        $data = request()->except('_token');
        $discount->fill($data['discount']);
        $discount->save();
        Toast::success($this->exist ? __('admin.info.groups.updated') : __('admin.info.groups.added'));
        redirect()->route('platform.discounts');
    }

}
