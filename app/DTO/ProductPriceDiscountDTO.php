<?php

namespace App\DTO;

use App\Models\Product;

class ProductPriceDiscountDTO implements DataTransferObjectInterface
{

    public Product $product;
    public float $price;
    public bool|float $priceWithDiscount;
    public string $discountBadgeText;

    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        Product $product,
        float $price,
        bool|float $priceWithDiscount,
        string $discountBadgeText,
    )
    {
        $this->product = $product;
        $this->price = $price;
        $this->priceWithDiscount = $priceWithDiscount;
        $this->discountBadgeText = $discountBadgeText;
    }
}