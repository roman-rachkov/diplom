<?php

namespace App\View\Components\Cart;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public GetCartServiceContract $cart;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(GetCartServiceContract $contract)
    {
        $this->cart = $contract;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart.header-component');
    }
}
