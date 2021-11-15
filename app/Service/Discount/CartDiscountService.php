<?php

namespace App\Service\Discount;

use App\Contracts\Repository\DiscountRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CartDiscountService implements CartDiscountServiceContract
{
    public function __construct(
        private DiscountRepositoryContract $discountRepository,
        private CustomerServiceContract $customerService
    )
    {}

    public function getCartDiscount(Customer $customer = null)
    {
        $customer = is_null($customer) ? $this->customerService->getCustomer() : $customer;
        $cartCost = $this->getCart($customer)
            ->reduce(
                function($carry, $orderItem){
                    return $carry + $orderItem->price->price;
                    },
                0);

        $productsQty = $this->getCart($customer)
            ->sum('quantity');

        $onCartDiscont = $this->discountRepository
            ->getMostWeightyCartOnCartDiscount($customer, $productsQty, $cartCost);

        $onSetDiscount = $this->discountRepository
            ->getMostWeightyCartOnSetDiscount(
                $this->getCart($customer)
                    ->reduce(
                        function($carry, $orderItem){
                            return $carry->push($orderItem->price->product_id);
                            },
                        collect()
                    ));

        return [
            'onCart' => $onCartDiscont,
            'onSet' => $onSetDiscount
        ];
    }

    protected function getCart(Customer $customer = null): Collection
    {
        return is_null($customer) ?
            $this->customerService->getCustomer()->cart :
            $customer->cart;

    }
}