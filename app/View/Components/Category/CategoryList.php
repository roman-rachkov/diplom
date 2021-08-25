<?php

namespace App\View\Components\Category;

use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategoryList extends Component
{
    /**
     * The collection of categories.
     *
     * @var Collection
     */
    public $categories;

    /**
     * Create the component instance.
     *
     * @param  Collection  $categories
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
        return view('components.category.category-list');
    }
}
