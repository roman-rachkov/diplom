<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\DTO\CartItemDTO;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Collection;

class GetCartService implements GetCartServiceContract
{
    protected Customer $customer;

    public function __construct(
        protected CustomerServiceContract $customerService,
        protected AdminSettingsServiceContract $settings,
        protected CartDiscountServiceContract $discountService,
        private OrderItemRepositoryContract $orderItemRepository,
        private ?Order $order = null
    )
    {
        $this->customer = $customerService->getCustomer();
    }

    public function setOrder(Order $order)
    {
        $this->order = $order;
        $this->customer = $order->customer;
    }


    public function getCartItemsDTOs(): Collection
    {
        return $this->discountService->getCartItemsDTOs(
            $this->getCartItemsList(),
            $this->getCartProductsQuantity(),
            $this->getCartCost(),
        );
    }

    public function getCartProductsQuantity(): int
    {
        return $this->getCartItemsList()->sum('quantity');
    }

    public function getTotalCost(?Collection $cartItemsDTOs = null): float
    {
        $dtos = is_null($cartItemsDTOs) ? $this->getCartItemsDTOs() : $cartItemsDTOs;

        return  $dtos->reduce(function ($carry,$item){
            return $item->sumPricesWithDiscount ?
                $carry + $item->sumPricesWithDiscount :
                $carry + $item->sumPrice;
        }, 0);
    }

    public function getCartCost(): float
    {
        return $this->getCartItemsList()->sum('sum');
    }

    public function getCartItemsList(): Collection
    {
        return cache()
            ->tags(['cart', 'orderItems'])
            ->remember(
                'cart-' . $this->customer->id . '-items',
                $this->settings->get('cartCacheLifeTime', 20 * 60),
                function () {
                    return $this->orderItemRepository->getCartByCustomer($this->customer, $this->order);
                });
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
