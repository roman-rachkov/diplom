<?php

namespace App\Orchid\Layouts\Seller;

use App\Models\Seller;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SellerListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'sellers';

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
                ->render(function (Seller $seller) {
                    $url = $seller->logo ? $seller->logo->getRelativeUrlAttribute() : '';
                    $alt = $seller->logo ?$seller->logo->getTitleAttribute() : 'No Logo';

                    return "<img src='{$url}'
                              alt='{$alt}'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$seller->id}</span>";
                }),
            TD::make('name', __('admin.sellers.title'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Seller $seller) {
                    return Link::make($seller->name)
                        ->route('platform.sellers.edit', $seller);
                }),

            TD::make('phone', __('admin.sellers.phone_title'))
                ->sort()
                ->render(function (Seller $seller) {
                    return $seller->phone;
                }),

            TD::make('email', __('Email'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Seller $seller) {
                    return $seller->email;
                }),

            TD::make('created_at', __('Created'))
                ->sort()
                ->render(function (Seller $seller) {
                    return $seller->created_at;
                }),

        ];
    }
}
