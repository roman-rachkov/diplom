<?php

namespace App\Orchid\Layouts\Config;

use App\Models\AdminSetting;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ConfigContactsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'contact';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Название опции')->width('500px'),
            TD::make('value', 'Значение опции'),
            TD::make('action')->render(function (AdminSetting $adminSetting) {
                return ModalToggle::make('Редактировать')
                    ->modal('editOption')
                    ->method('update')
                    ->modalTitle('Редактирование опции ' . $adminSetting->name)
                    ->asyncParameters([
                        'adminSetting' => $adminSetting->id,
                    ]);
            })->align(TD::ALIGN_RIGHT),
        ];
    }
}
