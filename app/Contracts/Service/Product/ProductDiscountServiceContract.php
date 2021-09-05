<?php

namespace App\Contracts\Service\Product;

use Illuminate\Support\Collection;

interface ProductDiscountServiceContract
{

    public function getAllDiscounts(Collection $products): array;

    public function getGeneralDiscount(Collection $products): array;

    public function getPriceWithDiscount(Collection $products): int;

}
