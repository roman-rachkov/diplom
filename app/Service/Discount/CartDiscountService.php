<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\Models\Customer;
use App\Models\Discount;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CartDiscountService implements CartDiscountServiceContract
{
    public function __construct(
        private DiscountRepositoryContract $discountRepository,
        private CustomerServiceContract $customerService,
        private OtherDiscountServiceContract $productDiscountService
    )
    {}

    public function getDiscountsDTOsForCart(Customer $customer = null): Collection
    {
        $customer = is_null($customer) ? $this->customerService->getCustomer() : $customer;

        $cartDiscount = $this->discountRepository->getOnCartDiscount(
                $customer->id, $this->getCart($customer)->sum('quantity'),
                $this->getCartCost($customer));

        //TODO получение корзины из репозитория? кеширование корзины?
        $productPriceItems = $this->getCart($customer)->map(function ($item) {
            $item->load('price.product');
            return $item;
        });

        $setDiscountArray = $this->getSetDiscountArray($this->getCartProductsIds($customer));

        if (!is_null($cartDiscount) && $cartDiscount->weight > $setDiscountArray['weight']) {
            Log::debug('cartDiscount__' . $this->createDTOs($productPriceItems, $cartDiscount));
            return $this->createDTOs($productPriceItems, $cartDiscount);
        }

        if(!is_null($setDiscountArray) && $setDiscountArray['weight'] > $cartDiscount->weight) {

            Log::debug('setDiscount__');
            return $this->createDTOs(
                $productPriceItems,
                $setDiscountArray['discount'],
                $setDiscountArray['productIds']);
        }

        Log::debug('productsDiscount__');
        return $this->createDTOs($productPriceItems);

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
                ->push($this
                    ->productDiscountService
                    ->getProductPriceDiscountDTO(
                        $item->price->product,
                        $item->price->price,
                        $discount
                    )
                );
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

    protected function getCart(Customer $customer = null): Collection
    {
        return is_null($customer) ?
            $this->customerService->getCustomer()->cart :
            $customer->cart;

    }

    protected function getCartCost(Customer $customer): float
    {
       return $this->getCart($customer)
            ->reduce(
                function($carry, $orderItem){
                    return $carry + $orderItem->price->price;
                },
                0);
    }

    protected function getCartProductsIds(Customer $customer): Collection
    {
        return $this->getCart($customer)
            ->reduce(
                function($carry, $orderItem){
                    return $carry->push($orderItem->price->product_id);
                },
                collect()
            );
    }

}