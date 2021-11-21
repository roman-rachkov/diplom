<?php

namespace App\View\Components\Cart;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MainComponent extends Component
{
    public Collection $cartItemsDTOs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public GetCartServiceContract $cartService,
    )
    {
        $this->cartItemsDTOs = $this->cartService->getCartItemsDTOs();
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
