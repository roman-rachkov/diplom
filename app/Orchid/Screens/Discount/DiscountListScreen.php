<?php

namespace App\Orchid\Screens\Discount;

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
        return [];
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
        return [];
    }
}
