<?php

namespace App\Orchid\Screens\Product;

use Orchid\Screen\Screen;

class ProductListScreen extends Screen
{
    public $permission = 'platform.elements.products';

    public function __construct()
    {
        $this->name = __('admin.products.screen_name');
        $this->description = __('admin.products.screen_description');
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
