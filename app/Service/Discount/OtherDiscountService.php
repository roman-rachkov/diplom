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


    public function __construct(
        private DiscountRepositoryContract $repository,
        private MethodTypeFactoryContract $methodTypeFactory,
        private PriceRepositoryContract $priceRepository,
    )
    {}

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
        false|null|Discount $discount = null
    ): DataTransferObjectInterface
    {
        $priceWithDiscount = false;
        $badge = false;

        if ($discount !== false) {
            $priceWithDiscount = $this->getProductPriceWithDiscount($product, $price, $discount);
            $badge = $this->getDiscountBadgeText($product,$discount);
        }

        $price = $price ?? $this->getAvgPrice($product);

        return ProductPriceDiscountDTO::create(
            [
                $product,
                $price,
                $priceWithDiscount,
                $badge
            ]
        );
    }

    public function getProductPriceWithDiscount(
        Product $product,
        ?float $price,
        ?Discount $discount = null
    ): bool|float
    {
        if ($discount = $this->getCurrentDiscount($product, $discount)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getPriceWithDiscount($price);
        }

        return false;
    }

    public function getDiscountBadgeText(Product $product, ?Discount $discount = null): bool|string
    {
        if ($discount = $this->getCurrentDiscount($product, $discount)) {
            return $this
                ->methodTypeFactory
                ->create($discount)
                ->getTextForBadge();
        }
        return false;
    }

    protected function getCurrentDiscount(Product $product, ?Discount $discount): ?Discount
    {
       return is_null($discount) ?  $this->repository->getProductDiscount($product) : $discount;
    }

    protected function getAvgPrice(Product $product): float
    {
       return round($product->prices->avg('price'));
    }

}