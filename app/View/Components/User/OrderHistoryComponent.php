<?php

namespace App\View\Components\User;

use App\Models\Order;
use Illuminate\View\Component;

class OrderHistoryComponent extends Component
{
    public Order $order;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user.order-history-component');
    }
}
