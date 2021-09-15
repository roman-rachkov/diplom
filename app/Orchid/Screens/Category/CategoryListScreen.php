<?php

namespace App\Orchid\Screens\Category;

use Orchid\Screen\Screen;

class CategoryListScreen extends Screen
{
    public $permission = 'platform.elements.category';

    public function __construct()
    {
        $this->name = __('admin.category.screen_name');
        $this->description = __('admin.category.screen_description');
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
