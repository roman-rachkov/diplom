<?php

namespace App\Contracts\Service\Product;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductDiscountServiceContract
{

    public function getAllDiscounts(Collection $products): Collection;

    public function getGeneralDiscount(Collection $products): Collection;

    public function getPriceWithDiscount(Collection $products): float;

    public function getProductDiscounts( Product $product): float;

    public function getCatalogDiscounts(Collection $products): Collection;

}
