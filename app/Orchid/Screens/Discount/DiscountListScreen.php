<?php

namespace App\Orchid\Screens\Discount;

use App\Models\Discount;
use App\Orchid\Layouts\Discounts\DiscountsListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class DiscountListScreen extends Screen
{
    public $permission = 'platform.elements.discounts';

    public function __construct()
    {
        $this->name = __('admin.discounts.screen_name');
        $this->description = __('admin.discounts.screen_description');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'discounts' => Discount::orderByDesc('created_at')->paginate(),
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
            Link::make(__('admin.discounts.add_discount'))
                ->icon('plus')
                ->route('platform.discounts.add')
        ];
    }

    public function updateList($args)
    {
        dd($args);
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            DiscountsListLayout::class,
        ];
    }
}
