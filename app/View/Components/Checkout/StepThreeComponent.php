<?php

namespace App\View\Components\Checkout;

use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Models\PaymentsService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StepThreeComponent extends Component
{
    public Collection $payments;
    public ?string $classes;
    public ?string $title;
    public ?string $button;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(PaymentsIntegratorServiceContract $contract, string $classes = null, string $title = null, string $button = null)
    {
        $this->payments = $contract->getAllPaymentsServices();
        $this->classes = $classes;
        $this->title = $title;
        $this->button = $button;
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
