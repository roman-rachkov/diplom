<?php

namespace App\View\Components\Category;

use App\Models\Category;
use Illuminate\View\Component;

class CategoryItem extends Component
{
    /**
     * The collection of categories.
     *
     * @var Category
     */
    public $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category.category-item');
    }
}
