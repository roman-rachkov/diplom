<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Repository\PriceRepositoryContract;
use App\Contracts\Service\Discount\MethodType\MethodTypeFactoryContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\DTO\DataTransferObjectInterface;
use App\DTO\ProductPriceDiscountDTO;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Support\Collection;

class OtherDiscountService implements OtherDiscountServiceContract
{
    private DiscountRepositoryContract $repository;

    private MethodTypeFactoryContract $methodTypeFactory;

    private PriceRepositoryContract $priceRepository;

    public function __construct(
        DiscountRepositoryContract $repository,
        MethodTypeFactoryContract $methodTypeFactory,
        PriceRepositoryContract $priceRepository
    )
    {
        $this->repository = $repository;
        $this->methodTypeFactory = $methodTypeFactory;
        $this->priceRepository = $priceRepository;
    }

    public function getProductPriceDiscountDTOs(Collection $products, ?Seller $seller = null): array
    {
        $productPricesWithDiscountsDTO = [];
        foreach ($products as $product) {
            $price = is_null($seller) ? null : $this->priceRepository->getSellerProductPrice($seller, $product);
            $productPricesWithDiscountsDTO[] = $this->getProductPriceDiscountDTO($product, $price);
        }
        return $productPricesWithDiscountsDTO;
    }

    public function getProductPriceDiscountDTO(
        Product $product,
        ?float $price = null,
        ?Discount $discount = null
    ): DataTransferObjectInterface
    {
        $price = $price ?? $this->getAvgPrice($product);

        return ProductPriceDiscountDTO::create(
            [
                $product,
                $price,
                $this->getProductPriceWithDiscount($product, $price, $discount),
                $this->getDiscountBadgeText($product)
            ]
        );
    }

    public function getProductPriceWithDiscount(Product $product, float $price, ?Discount $discount = null): bool|float
    {
        $discount = !is_null($discount) ? $discount : $this->repository->getProductDiscount($product);

        if ($discount) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getPriceWithDiscount($price);
        }

        return false;
    }

    public function getDiscountBadgeText(Product $product): bool|string
    {
        if ($discount = $this->repository->getProductDiscount($product)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getTextForBadge();
        }
        return false;
    }

    protected function getAvgPrice(Product $product): float
    {
       return round($product->prices->avg('price'));
    }

}