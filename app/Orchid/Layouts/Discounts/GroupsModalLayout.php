<?php

namespace App\Orchid\Layouts\Discounts;

use App\Models\Category;
use App\Models\Product;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Layouts\Rows;

class GroupsModalLayout extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('title')
                ->title(__('admin.discounts.groups.title'))
                ->required(),
            Relation::make('grouppable.products')
                ->title(__('admin.products.panel_name'))
                ->fromModel(Product::class, 'name')
                ->multiple(),
            Relation::make('grouppable.categories')
                ->title(__('admin.category.panel_name'))
                ->fromModel(Category::class, 'name')
                ->multiple(),
        ];
    }
}
