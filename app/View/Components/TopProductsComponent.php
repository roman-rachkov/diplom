<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopProductsComponent extends Component
{

    public array $productPricesWithDiscountsDTO;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $productPricesWithDiscountsDTO)
    {
        $this->productPricesWithDiscountsDTO = $productPricesWithDiscountsDTO;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render()
    {
        return view('components.top-products-component');
    }
}
