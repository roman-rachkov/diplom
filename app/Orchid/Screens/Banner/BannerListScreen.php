<?php

namespace App\Orchid\Screens\Banner;

use App\Models\Banner;
use App\Orchid\Layouts\Banner\BannerListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class BannerListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Manage Banners';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'banners' => Banner::filters()->defaultSort('id')->paginate()
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
            Link::make('Create new')
                ->icon('plus')
                ->route('platform.banner.edit')
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
            BannerListLayout::class
        ];
    }
}
