<?php

namespace App\View\Components\Cart;

use App\Contracts\Service\CartServiceContract;
use Illuminate\View\Component;

class MainComponent extends Component
{
    public CartServiceContract $cartService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CartServiceContract $contract)
    {
        $this->cartService = $contract;
    }

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
