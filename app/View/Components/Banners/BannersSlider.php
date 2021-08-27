<?php

namespace App\View\Components\Banners;

use App\Repository\BannerRepository;
use Illuminate\View\Component;

class BannersSlider extends Component
{
    public $banners;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(BannerRepository $repo)
    {
        $this->banners = $repo->getBanners();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
//        dd($this->banners);
        return view('components.banners.banners-slider');
    }
}
