<?php

namespace App\Orchid\Layouts\Import;

use Illuminate\Support\Carbon;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AwaitLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'awaitFiles';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title', __('import.tabs.tdTitle'))
                ->render(function ($fileArr) {
                    return $fileArr->original_name;
                }),

            TD::make('createdTime', __('import.tabs.tdCreatedTime'))
                ->render(function ($fileArr) {
                    return $fileArr->created_at->format('d-m-Y H:i');
                }),


            TD::make('createdTime', __('import.tabs.action'))
                ->alignRight()
                ->render(function ($fileArr) {
                    return Button::make(__('import.mainscreen.startImport'))
                                ->method('startImportForOneFile')
                                ->icon('control-play')
                                ->parameters([ 'id' => $fileArr->id ]);
                }),
        ];
    }
}
