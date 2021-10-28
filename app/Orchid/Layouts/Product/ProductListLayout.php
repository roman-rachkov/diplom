<?php

namespace App\Orchid\Layouts\Product;

use App\Models\Product;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

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
                ->render(function (Product $product) {
                    return "<img src='{$product->image->url()}'
                              alt='{$product->image->getTitleAttribute()}'
                              class='mw-100 d-block img-fluid'>
                            <span class='small text-muted mt-1 mb-0'># {$product->id}</span>";
                }),

            TD::make('name', __('admin.products.name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Product $product) {
                    return Link::make($product->name)
                        ->route('platform.products.edit', $product);
                }),

            TD::make('created_at', __('Created'))
                ->sort()
                ->render(function (Product $product) {
                    return $product->created_at;
                }),
            TD::make('updated_at', __('Last edit'))
                ->sort()
                ->render(function (Product $product) {
                    return $product->updated_at;
                }),
        ];
    }
}
