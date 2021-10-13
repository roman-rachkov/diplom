<?php

namespace App\DTO;

use Orchid\Attachment\Models\Attachment;

class CompareProductDTO implements DataTransferObjectInterface
{
    public string $productName;
    public string $productSlug;
    public Attachment $productImg;
    public string $productAvgPrice;
    public float $productPriceWithDiscount;

    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        string $productName,
        string $productSlug,
        Attachment $productImg,
        string $productAvgPrice,
        float $productPriceWithDiscount,
    )
    {
        $this->productName = $productName;
        $this->productSlug = $productSlug;
        $this->productImg = $productImg;
        $this->productAvgPrice = $productAvgPrice;
        $this->productPriceWithDiscount = $productPriceWithDiscount;
    }
}