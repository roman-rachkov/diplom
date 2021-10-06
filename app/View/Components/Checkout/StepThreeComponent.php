<?php

namespace App\View\Components\Checkout;

use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Models\PaymentsService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StepThreeComponent extends Component
{
    public Collection $payments;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PaymentsIntegratorServiceContract $contract)
    {
        $this->payments = $contract->getAllPaymentsServices();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkout.step-three-component');
    }
}
