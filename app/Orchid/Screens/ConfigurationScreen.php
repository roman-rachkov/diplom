<?php

namespace App\Orchid\Screens;

use App\Models\AdminSetting;
use App\Orchid\Layouts\Config\ConfigContactsLayout;
use App\Orchid\Layouts\Config\ConfigDeliversLayout;
use App\Orchid\Layouts\Config\ConfigUsersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
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
            'contact' => AdminSetting::where('category', 'contact')->get(),
            'delivery' => AdminSetting::where('category', 'delivery')->get(),
            'user' => AdminSetting::where('category', 'user')->get(),
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
            Button::make('Reset')->method('resetAdminSetting')
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
            Layout::tabs([
                'Контакты' => ConfigContactsLayout::class,
                'Доставка' => ConfigDeliversLayout::class,
                'Пользователь' => ConfigUsersLayout::class,
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

    public function resetAdminSetting()
    {
        resetConfiguration();
    }
}
