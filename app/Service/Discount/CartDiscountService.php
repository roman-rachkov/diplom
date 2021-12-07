<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\DTO\CartItemDTO;
use App\Models\Customer;
use App\Models\Discount;
use App\Models\OrderItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CartDiscountService implements CartDiscountServiceContract
{
    public function __construct(
        private DiscountRepositoryContract $discountRepository,
        private OtherDiscountServiceContract $productDiscountService
    )
    {}

    public function getCartItemsDTOs(
        Collection $cart,
        int $cartQuantity,
        float $cartCost,
    ): Collection
    {
        $cartDiscount = $this->discountRepository
            ->getOnCartDiscount($cartQuantity, $cartCost);

        $setDiscountArray = $this->getSetDiscountArray($this->getCartProductsIds($cart));

        if(!is_null($setDiscountArray) && !is_null($cartDiscount)) {

            if ($setDiscountArray['weight'] > $cartDiscount->weight) {
                return $this->createDTOs(
                    $cart,
                    $setDiscountArray['discount'],
                    $setDiscountArray['productIds']);
            } else {
                return $this->createDTOs($cart, $cartDiscount);
            }
        }

        if(!is_null($setDiscountArray)) {
            return $this->createDTOs(
                $cart,
                $setDiscountArray['discount'],
                $setDiscountArray['productIds']);
        }

        if(!is_null($cartDiscount)) {
            return $this->createDTOs($cart, $cartDiscount);
        }


        return $this->createDTOs($cart);
    }

    protected function createDTOs(
        Collection $productPriceItems,
        Discount $discount = null,
        ?Collection $onlyWithDiscountProductIds = null,
    ): Collection
    {
        $productPriceDiscountDTOs = collect([]);
        $productPriceItems->each(function ($item) use (
            $onlyWithDiscountProductIds,
            $productPriceDiscountDTOs,
            $discount
        ) {
            if (!is_null($onlyWithDiscountProductIds) &&
                !$onlyWithDiscountProductIds->contains($item->price->product->id)
            ) $discount = false;

            $productPriceDiscountDTOs
                ->push(CartItemDTO::create(
                    [
                        $item->price->product,
                        $item->price,
                        $item->quantity,
                        $this->countSumPrice($item),
                        $discount === false ? false : $this->countSumDiscountPrice($item, $discount)
                    ]
                ));
        });

        return $productPriceDiscountDTOs;
    }

    protected function getSetDiscountArray(Collection $productIds)
    {
        return $this->discountRepository
            ->getOnSetDiscounts()
            ->map(function ($discount) use ($productIds) {
                $countOfIntersected = 0;
                $discountProductIds = collect();
                foreach ($discount->discountGroups as $discountGroup) {
                    $intersectedDiscountGroupProductIds = $discountGroup
                        ->categories
                        ->reduce(
                            function($carry, $category){
                                return $carry->merge($category->products->pluck('id'));
                            },
                            collect()
                        )
                        ->merge($discountGroup->products->pluck('id'))
                        ->intersect($productIds);
                    if ($intersectedDiscountGroupProductIds->isNotEmpty()) {
                        $discountProductIds = $discountProductIds
                            ->merge($intersectedDiscountGroupProductIds);
                        $countOfIntersected++;
                    }
                }
                if ($countOfIntersected > 1) {
                    return
                        [
                            'discount' => $discount,
                            'productIds' => $discountProductIds,
                            'weight' => $discount->weight
                        ];
                }
                return null;
            })
            ->filter(function ($discount) {
                return !is_null($discount);
            })
            ->sortByDesc('weight')
            ->first();
    }

    protected function getCartProductsIds(Collection $cart): Collection
    {
        return $cart->reduce(
                function($carry, $orderItem){
                    return $carry->push($orderItem->price->product_id);
                },
                collect()
            );
    }

    protected function countSumPrice(OrderItem $item): float|int
    {
        return $item->price->price * $item->quantity;
    }

    protected function countSumDiscountPrice(OrderItem $item, ?Discount $discount): float|int
    {
        return round($item->quantity *
            $this->productDiscountService->getProductPriceWithDiscount(
                $item->price->product,
                $this->countSumPrice($item),
                $discount
        ), 2);
    }

}