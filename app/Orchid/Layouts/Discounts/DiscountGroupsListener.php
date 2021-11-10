<?php

namespace App\Orchid\Layouts\Discounts;

use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Layouts\Listener;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class DiscountGroupsListener extends Listener
{
    /**
     * List of field names for which values will be listened.
     *
     * @var string[]
     */
    protected $targets = [
        'discount.id',
        'discount.groups.count',
        'discount.category_type',
        'discount.value',
        'discount.method_type',
        'discount.weight',
        'discount.start_at',
        'discount.end_at',
        'discount.description',
    ];

    /**
     * What screen method should be called
     * as a source for an asynchronous request.
     *
     * The name of the method must
     * begin with the prefix "async"
     *
     * @var string
     */
    protected $asyncMethod = 'asyncGroups';

    /**
     * @return Layout[]
     */
    protected function layouts(): array
    {
        $fields = [];
        if ($this->query['discount.groups.count'] > 0) {
            for ($i = 0; $i < $this->query['discount.groups.count']; $i++) {
                $fields[] = GroupsModalLayout::class;
            }
        }
        return [
            Layout::rows([
                Input::make('discount.groups.count')
                    ->type('number')
                    ->min(0)
                    ->title(__('admin.discounts.groups.count'))
                    ->value($this->query['discount.groups.count']),

            ]),
            Layout::accordion([
                __('admin.discounts.category.groups.title') => $fields
            ])
        ];
    }
}
