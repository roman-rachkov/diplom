<?php

namespace App\View\Components\Checkout;

use App\Contracts\Service\Cart\GetCartServiceContract;
use Illuminate\View\Component;

class FormComponent extends Component
{
    public GetCartServiceContract $cart;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(GetCartServiceContract $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkout.form-component');
    }
}
