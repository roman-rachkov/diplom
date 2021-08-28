<?php

namespace App\Orchid\Screens;

use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ConfigurationScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Настройки';
    public  $description = 'Страница изменения настроек';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        initialConfigurationFilling();

        return [
            'options' => AdminSetting::all()
        ];
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
        return [
            Layout::table('options', [
                TD::make('name', 'Название опции'),
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
            ]),
            Layout::modal('editOption', Layout::rows([
                Input::make('adminSetting.id')->type('hidden'),
                Input::make('adminSetting.name')->disabled()->title('Название опции'),
                Input::make('adminSetting.value')->required()->title('Значение опции'),
            ]))->title('Редактирование опции')->applyButton('Редактировать')->async('asyncGetAdminSetting'),
        ];
    }

    public function asyncGetAdminSetting(AdminSetting $adminSetting) {
        return [
            'adminSetting' => $adminSetting
        ];
    }

    public function update(Request $request) {
        $adminSetting = AdminSetting::find($request->input('adminSetting.id'))->update($request->adminSetting);
        Toast::info('Успешно обновлено');
    }
}
