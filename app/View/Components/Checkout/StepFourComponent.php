<?php

namespace App\View\Components\Checkout;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StepFourComponent extends Component
{
    public array $inputs;
    public Collection $cartItemsDTOs;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $inputs,
        public GetCartServiceContract $cartService)
    {
        $this->inputs = $inputs;
        $this->cartItemsDTOs = $this->cartService->getCartItemsDTOs();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkout.step-four-component');
    }
}
