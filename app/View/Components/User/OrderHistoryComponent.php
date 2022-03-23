<?php

namespace App\View\Components\User;

use App\Contracts\Service\OrderServiceContract;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderHistoryComponent extends Component
{
    public OrderServiceContract $orderService;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public User $user,
        public ?Order $order,
        public bool $showElement)
    {
        $this->orderService = app()->makeWith(
            OrderServiceContract::class,
            ['order' => $order]);
    }

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
