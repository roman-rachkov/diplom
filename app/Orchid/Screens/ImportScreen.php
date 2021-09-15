<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;

class ImportScreen extends Screen
{
    public $permission = 'platform.systems.import';

    public function __construct()
    {
        $this->name = __('admin.import.screen_name');
        $this->description = __('admin.import.screen_description');
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
