<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\Models\Customer;
use App\Models\Discount;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CartDiscountService implements CartDiscountServiceContract
{
    public function __construct(
        private DiscountRepositoryContract $discountRepository,
        private CustomerServiceContract $customerService
    )
    {}

    public function getDiscountsDTOsForCart(Customer $customer = null)
    {
        $customer = is_null($customer) ? $this->customerService->getCustomer() : $customer;

        $cartDiscount = $this->discountRepository->getOnCartDiscount(
                $customer, $this->getCart($customer)->sum('quantity'),
                $this->getCartCost($customer));
        $productIds = $this->getCartProductsIds($customer);
        $setDiscountArray = $this->getSetDiscountArray();

        if (!is_null($cartDiscount) && $cartDiscount->weight > $setDiscountArray['weight']) {
            $currentCartDiscount = $cartDiscount;
            $withDiscountProductIds = $productIds;
        }

        if(!is_null($setDiscountArray) && $setDiscountArray['weight'] > $cartDiscount->weight) {
            $currentCartDiscount = $setDiscountArray['discount'];
            $withDiscountProductIds = $setDiscountArray['productIds'];
        }



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

    protected function getProductsPricesDiscountDTOs(Discount $discount, $productIds, $productWithDiscountIds)
    {

    }
}