<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\DTO\DataTransferObjectInterface;
use App\DTO\ProductPriceDiscountDTO;
use App\Models\Product;
use Illuminate\Support\Collection;

class OtherDiscountService implements OtherDiscountServiceContract
{
    private DiscountRepositoryContract $repository;

    private MethodTypeFactoryContract $methodTypeFactory;

    public function __construct(DiscountRepositoryContract $repository, MethodTypeFactoryContract $methodTypeFactory)
    {
        $this->repository = $repository;
        $this->methodTypeFactory = $methodTypeFactory;
    }

    public function getProductPriceDiscountDTOs(Collection $products): array
    {
        $productPricesWithDiscountsDTO = [];
        foreach ($products as $product) {
            $productPricesWithDiscountsDTO[] = $this->getProductPriceDiscountDTO($product);
        }
        return $productPricesWithDiscountsDTO;
    }

    public function getProductPriceDiscountDTO(Product $product): DataTransferObjectInterface
    {
        $price = $this->getPrice($product);

        return ProductPriceDiscountDTO::create(
            [
                $product,
                $price,
                $this->getProductPriceWithDiscount($product, $price),
                $this->getDiscountBadgeText($product)
            ]
        );
    }

    public function getProductPriceWithDiscount(Product $product, ?float $price = null): bool|float
    {
        $price = $price ?? $this->getPrice($product);

        if ($discount = $this->repository->getMostWeightyProductDiscount($product)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getPriceWithDiscount($price);
        }

        return false;
    }

    public function getDiscountBadgeText(Product $product): bool|string
    {
        if ($discount = $this->repository->getMostWeightyProductDiscount($product)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getTextForBadge();
        }
        return false;
    }

    protected function getPrice(Product $product)
    {
       return round($product->prices->avg('price'));
    }

}