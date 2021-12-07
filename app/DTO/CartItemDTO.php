<?php

namespace App\DTO;

use App\Models\Price;
use App\Models\Product;

class CartItemDTO implements DataTransferObjectInterface
{
    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        public Product $product,
        public Price $price,
        public int $quantity,
        public float $sumPrice,
        public false|float $sumPricesWithDiscount
    )
    {}
}