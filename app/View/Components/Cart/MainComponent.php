<?php

namespace App\View\Components\Cart;

use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use Illuminate\View\Component;

class MainComponent extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public CartDiscountServiceContract $discountService,
        public GetCartServiceContract $contract)
    {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart.main-component');
    }
}
