<?php

namespace App\DTO;

use App\Models\Product;
use Orchid\Attachment\Models\Attachment;

class CompareProductDTO implements DataTransferObjectInterface
{
    public Product $product;
    public bool|float $productPriceWithDiscount;

    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        Product $product,
        bool|float $productPriceWithDiscount,
    )
    {
        $this->product = $product;
        $this->productPriceWithDiscount = $productPriceWithDiscount;
    }

    public function getPriceInDollars(float $value): bool|string
    {
        $fmt = new \NumberFormatter( 'en_EN', \NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($value, "USD");
    }
}