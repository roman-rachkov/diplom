<?php

namespace App\Orchid\Screens;

use App\Models\AdminSetting;
use App\Orchid\Layouts\Config\ConfigContactsLayout;
use App\Orchid\Layouts\Config\ConfigDeliversLayout;
use App\Orchid\Layouts\Config\ConfigUsersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ConfigurationScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name;
    public  $description;

    public function __construct()
    {
        $this->name = __('admin_settings.Name');
        $this->description = __('admin_settings.Description');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $categories = AdminSetting::all()->groupBy('category');

        return [
            'categories' => $categories,
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
            Layout::tabs([
                __('admin_settings.Contacts') => ConfigContactsLayout::class,
                __('admin_settings.Delivery') => ConfigDeliversLayout::class,
                __('admin_settings.User') => ConfigUsersLayout::class,
                ]),
            Layout::modal('editOption', Layout::rows([
                Input::make('adminSetting.id')->type('hidden'),
                Input::make('adminSetting.name')->disabled()->title(__('admin_settings.Title')),
                Input::make('adminSetting.value')->required()->title(__('admin_settings.Value')),
            ]))->title(__('admin_config.editing'))->applyButton(__('admin_settings.Update'))->async('asyncGetAdminSetting'),
        ];
    }

    public function asyncGetAdminSetting(AdminSetting $adminSetting) {
        return [
            'adminSetting' => $adminSetting
        ];
    }

    public function update(Request $request) {
        $adminSetting = AdminSetting::find($request->input('adminSetting.id'))->update($request->adminSetting);
        Toast::info(__('admin_settings.updated'));
    }

}
