<?php

namespace App\Contracts\Service\Discount;

use App\Models\Product;

interface OtherDiscountServiceContract
{
    public function getProductPriceWithDiscount(Product $product, ?float $price = null): bool|float;

    public function getDiscountBadgeText(Product $product): bool|string;
}