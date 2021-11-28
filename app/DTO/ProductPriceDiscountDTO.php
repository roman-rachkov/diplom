<?php

namespace App\DTO;

use App\Models\Discount;
use App\Models\Product;

class ProductPriceDiscountDTO implements DataTransferObjectInterface
{

    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        public Product $product,
        public float $price,
        public bool|float $priceWithDiscount,
        public Discount $discount
    )
    {}
}