<?php

namespace App\Orchid\Layouts\Discounts;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;

class DiscountGroupsListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = '';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        $fields = [];
        if ($this->query['discount.discountGroups.count'] > 0) {
            for ($i = 0; $i < $this->query['discount.discountGroups.count']; $i++) {
                $fields[] = GroupsLayout::getRowsWithId($i);
            }
        }
        return [
            Layout::rows([
                Input::make('discount.discountGroups.count')
                    ->type('number')
                    ->min(2)
                    ->title(__('admin.discounts.groups.count'))
                    ->value($this->query['discount.discountGroups.count']),
            ]),
            Layout::accordion([
                __('admin.discounts.category.groups.title') => $fields
            ])

        ];
    }
}
