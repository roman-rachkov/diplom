<?php

namespace App\View\Components\Checkout;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\View\Component;

class StepFourComponent extends Component
{
    public $inputs;
    public GetCartServiceContract $cartService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($inputs, GetCartServiceContract $contract)
    {
        $this->inputs = $inputs;
        $this->cartService = $contract;
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
