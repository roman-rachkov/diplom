<?php

namespace App\View\Components;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TopProductsComponent extends Component
{

    public Collection $products;
    public Collection $discounts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $products, Collection $discounts)
    {
        $this->products = $products;
        $this->discounts = $discounts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.top-products-component');
    }
}
