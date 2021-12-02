<?php

namespace App\Orchid\Layouts\Import;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ErrorLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'errorFiles';

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
                    return $fileArr['name'];
                })
        ];
    }
}
