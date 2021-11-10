<?php

namespace App\Contracts\Service\Discount;

use App\DTO\DataTransferObjectInterface;
use App\Models\Product;
use Illuminate\Support\Collection;

interface OtherDiscountServiceContract
{
    public function getProductPriceWithDiscount(Product $product, ?float $price = null): bool|float;

    public function getDiscountBadgeText(Product $product): bool|string;

    public function getProductPriceDiscountDTOs(Collection $products): array;

    public function getProductPriceDiscountDTO(Product $product): DataTransferObjectInterface;
}