<?php

namespace App\View\Components\Discount;

use App\Models\Discount;
use Illuminate\View\Component;

class Badge extends Component
{
    public string $discountBadgeText;
    private float $discountValue;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Discount $discount, public $priceWithDiscount)
    {
        $this->discountValue = round($this->discount->value);
        $this->discountBadgeText = $this->getDiscountBadgeText();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.discount.badge');
    }

    protected function getDiscountBadgeText(): string
    {
        return
            [
                Discount::METHOD_CLASSIC => '-' . $this->discountValue . '%',
                Discount::METHOD_SUM => '-' . $this->discountValue . '$',
                Discount::METHOD_FIXED => 'FIX PRICE!',
            ][$this->discount->method_type];
    }

}
