<?php

namespace App\View\Components\Category;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategorySubmenu extends Component
{

    /**
     * The category repository.
     *
     * @var Collection
     */
    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category.category-submenu');
    }
}
