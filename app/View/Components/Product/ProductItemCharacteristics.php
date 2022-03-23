<?php

namespace App\View\Components\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductItemCharacteristics extends Component
{
    public Collection $characteristics;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public Product $product
    )
    {
        $this->characteristics = $this->getCharacterisctics();
    }

    protected function getCharacterisctics(): Collection
    {
       return $this->product
            ->category
            ->characteristics
            ->map(function ($characteristic) {

                $value = $this
                    ->product
                    ->characteristicValues
                    ->firstWhere('characteristic_id', $characteristic->id)?->value;

                if (!is_null($value)) $value = $value . ' ' . $characteristic->measure;

               return
                   [
                       'name' => $characteristic->name,
                       'value' => $value
                   ];
            });
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product.product-item-characteristics');
    }
}
