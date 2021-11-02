<?php

namespace App\Orchid\Layouts;

use App\Orchid\Filters\DeliveryTypeFilter;
use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;

class DeliveryTypeSelection extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            DeliveryTypeFilter::class
        ];
    }
}
