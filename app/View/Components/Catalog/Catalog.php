<?php

namespace App\View\Components\Catalog;

use App\Repository\ProductRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\View\Component;

class Catalog extends Component
{
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.catalog.catalog');
    }
}
