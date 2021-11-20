<?php

namespace App\View\Components\Cart;

use App\Contracts\Repository\PriceRepositoryContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class MainComponent extends Component
{
    public GetCartServiceContract $cartService;
    public Collection $cartItemsDTOs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        GetCartServiceContract $contract,
        private CartDiscountServiceContract $discountService,
    )
    {
        $this->cartService = $contract;
        $this->cartItemsDTOs = $this->discountService->getCartItemsDTOs();
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
