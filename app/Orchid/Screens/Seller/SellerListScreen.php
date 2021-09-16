<?php

namespace App\Orchid\Screens\Seller;

use Orchid\Screen\Screen;

class SellerListScreen extends Screen
{
    public $permission = 'platform.elements.sellers';

    public function __construct()
    {
        $this->name = __('admin.sellers.screen_name');
        $this->description = __('admin.sellers.screen_description');
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
