<?php

namespace App\Contracts\Service\Discount;

use App\DTO\DataTransferObjectInterface;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

interface OtherDiscountServiceContract
{
    public function getProductPriceWithDiscount(Product $product, float $price): bool|float;

    public function getDiscountBadgeText(Product $product): bool|string;

    public function getProductPriceDiscountDTOs(Collection $products, ?Seller $seller = null): array;

    public function getProductPriceDiscountDTO(Product $product, ?float $price = null): DataTransferObjectInterface;
}