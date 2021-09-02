<?php

namespace App\Orchid\Layouts\Config;

use App\Models\AdminSetting;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ConfigUsersLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'categories.user';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', __('admin_settings.Title'))->width('500px'),
            TD::make('value', __('admin_settings.Value')),
            TD::make('action', __('admin_settings.Action'))->render(function (AdminSetting $adminSetting) {
                return ModalToggle::make(__('admin_settings.Edit'))
                    ->modal('editOption')
                    ->method('update')
                    ->modalTitle(__('admin_settings.editing') . $adminSetting->name)
                    ->asyncParameters([
                        'adminSetting' => $adminSetting->id,
                    ]);
            })->align(TD::ALIGN_RIGHT),
        ];
    }
}
