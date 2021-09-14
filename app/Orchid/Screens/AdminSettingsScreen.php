<?php

namespace App\Orchid\Screens;

use App\Models\AdminSetting as SettingModel;
use App\Orchid\Layouts\AdminSetting;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

class AdminSettingsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Main Settings';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'settings' => SettingModel::all(),
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
            Button::make(__('update'))
                ->icon('refresh')
                ->method('update')
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
            AdminSetting::class
        ];
    }

    public function update(Request $request){
        foreach ($request->except('_token') as $key=>$value){
            $setting = SettingModel::where('variable', $key)->first();
            $setting->value = $value;
            $setting->save();
        }
    }

}
