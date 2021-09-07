<?php

namespace App\Contracts\Service\Product;

use Illuminate\Support\Collection;

interface ProductDiscountServiceContract
{

    public function getAllDiscounts(Collection $products): Collection;

    public function getGeneralDiscount(Collection $products): Collection;

    public function getPriceWithDiscount(Collection $products): int;

}
