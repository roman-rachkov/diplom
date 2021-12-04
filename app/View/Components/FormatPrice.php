<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormatPrice extends Component
{
    public string $price;
    public string $currency;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($price, $currency = '$')
    {
        $this->currency = $currency;
        $this->price = number_format((float)$price, 2, '.', '&nbsp;');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.format-price');
    }
}
