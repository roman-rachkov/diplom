<?php

namespace App\Orchid\Layouts\Product;

use App\Models\AdminSetting;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SellerPriceTableLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'prices';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', __('admin.products.name'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Price $prices) {
                    return $prices->seller->name;
                }),
            TD::make('price', __('admin.products.prices'))
                ->sort()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Price $prices) {
                    return $prices->price;
                }),
            TD::make('updatePriceAndSeller', __('admin.settings.Action'))->render(function (Price $prices) {
                return ModalToggle::make(__('admin.products.edit_button'))
                    ->modal('editPriceAndSeller')
                    ->method('updatePriceAndSeller')
                    ->modalTitle(__('admin.products.edit_modal_title') . $prices->seller->name)
                    ->asyncParameters([
                        'price' => $prices->id
                    ]);
            })->align(TD::ALIGN_RIGHT),
        ];
    }
}
