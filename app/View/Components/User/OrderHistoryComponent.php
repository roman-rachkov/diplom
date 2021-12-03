<?php

namespace App\View\Components\User;

use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderHistoryComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public User $user,
        public ?Order $order,
        public bool $showElement)
    {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.user.order-history-component');
    }
}
