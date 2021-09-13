<?php

namespace App\View\Components\Catalog;

use Illuminate\Pagination\PaginationServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $paginator;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.catalog.pagination');
    }
}
