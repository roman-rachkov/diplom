<?php

namespace App\Orchid\Screens\Seller;

use App\Models\Seller;
use App\Orchid\Layouts\Seller\SellerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class SellerListScreen extends Screen
{
    public $permission = 'platform.elements.sellers';

    public function __construct()
    {
        $this->name = __('admin.sellers.screen_name');
        $this->description = __('admin.sellers.screen_description');
    }
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
           'sellers' => Seller::filters()->defaultSort('id')->paginate()
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
            Link::make(__('admin.sellers.add_new_seller'))
                ->icon('plus')
                ->route('platform.sellers.add')
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
            SellerListLayout::class
        ];
    }
}
