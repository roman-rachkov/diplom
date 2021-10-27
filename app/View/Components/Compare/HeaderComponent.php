<?php

namespace App\View\Components\Compare;

use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\Customer;
use Illuminate\View\Component;

class HeaderComponent extends Component
{
    public int $comparedProductsCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(CompareProductsServiceContract $compareService, CustomerServiceContract $customer)
    {
        $this->comparedProductsCount = $compareService->getCount($customer->getCustomer());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.compare.header-component');
    }
}
