<?php

namespace App\Orchid\Layouts\Banner;

use App\Models\Banner;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class BannerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'banners';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->width('150')
                ->render(function (Banner $banner) {
                    return "<img src='{$banner->image->getRelativeUrlAttribute()}'
                              alt='sample'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$banner->id}</span>";
                }),

            TD::make('title', 'Title')
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Banner $banner) {
                    return Link::make($banner->title)
                        ->route('platform.banner.edit', $banner);
                }),

            TD::make('is_active', 'Active')
                ->sort()
                ->filter(TD::FILTER_NUMERIC)
                ->render(function (Banner $banner) {
                    return $banner->is_active ? 'YES' : 'NO';
                }),

            TD::make('created_at', 'Created')
                ->sort()
                ->render(function (Banner $banner) {
                    return $banner->created_at;
                }),
            TD::make('updated_at', 'Last edit')
                ->sort()
                ->render(function (Banner $banner) {
                    return $banner->updated_at;
                }),
        ];
    }
}
