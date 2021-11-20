<?php

namespace App\Contracts\Service\Discount;

use App\DTO\DataTransferObjectInterface;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

interface OtherDiscountServiceContract
{
    public function getProductPriceWithDiscount(Product $product, float $price, ?Discount $discount = null): bool|float;

    public function getProductPriceDiscountDTOs(Collection $products, ?Seller $seller = null): array;

    public function getProductPriceDiscountDTO(Product $product, ?float $price = null): DataTransferObjectInterface;
}