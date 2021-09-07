<?php

namespace App\View\Components\Category;

use App\Repository\CategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategoryList extends Component
{
    /**
     * The category repository.
     *
     * @var Collection
     */
    public $categories;

    /**
     * Create the component instance.
     *
     * @param  CategoryRepository  $repo
     * @return void
     */
    public function __construct(CategoryRepository $repo)
    {
        $this->categories = $repo->getCategories();
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
