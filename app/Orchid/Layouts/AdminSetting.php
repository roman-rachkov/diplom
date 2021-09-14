<?php

namespace App\Orchid\Layouts;

use Orchid\Icons\Icon;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AdminSetting extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'settings';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('info', '')
                ->width(48)
                ->render(function ($setting) {
                    return view('admin.tooltip', ['tooltip' => $setting->name]);
                }),
            TD::make('variable', __('Variable'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function ($setting) {
                    return $setting->variable;
                }),
            TD::make('value', __('Value'))
                ->render(function ($setting) {
                    return Input::make($setting->variable)
                        ->placeholder(__('Value'))
                        ->value($setting->value);
                }),
        ];
    }
}
