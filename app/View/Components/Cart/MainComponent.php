<?php

namespace App\View\Components\Cart;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\View\Component;

class MainComponent extends Component
{
    public GetCartServiceContract $cartService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(GetCartServiceContract $contract)
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
