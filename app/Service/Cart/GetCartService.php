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
        CustomerServiceContract $customerService,
        protected AdminSettingsServiceContract $settings,
        protected CartDiscountServiceContract $discountService,
        private OrderItemRepositoryContract $orderItemRepository
    )
    {
        $this->customer = $customerService->getCustomer();
    }


    public function getCartItemsDTOs(): Collection
    {
        return $this->discountService->getCartItemsDTOs(
            $this->getCartItemsList(),
            $this->getCartProductsQuantity(),
            $this->getCartCost(),
            $this->customer->id
        );
    }

    public function getCartProductsQuantity(): int
    {
        return $this->getCartItemsList()->sum('quantity');
    }

    public function getTotalCost(): float
    {
        return  $this->getCartItemsDTOs()->reduce(function ($carry,$item){
            return $item->sumPricesWithDiscount ?
                $carry + $item->sumPricesWithDiscount :
                $carry + $item->sumPrice;
        }, 0);
    }

    public function getCartCost(): float
    {
        return $this->getCartItemsList()->sum('sum');
    }

    public function getOrderItemsDTOs(Order $order): Collection
    {
        if ($order->payment?->payed_at != null) {
            return $this->getPaidOrderDTOs($order);
        }

        return $this->getUnpaidOrderDTOs($order);
    }

    protected function getPaidOrderDTOs(Order $order): Collection
    {
        $items = $this->getOrderItems($order);

        return $items->map(function ($item) {
            return CartItemDTO::create(
                [
                    $item->price->product,
                    $item->price,
                    $item->quantity,
                    $item->history_price,
                    $item->history_discount
                ]);
        });
    }

    protected function getUnpaidOrderDTOs(Order $order): Collection
    {
        $items = $this->getOrderItems($order);;

        return $this->discountService->getOrderItemsDTOs(
            $items,
            $items->sum('quantity'),
            $items->sum('sum'),
            $order->id
        );
    }

    protected function getOrderItems(Order $order): Collection
    {
        return $this->orderItemRepository->getOrderItemsByOrder($order);
    }

    public function getCartItemsList(): Collection
    {
        return cache()
            ->tags(['cart', 'orderItems'])
            ->remember(
                'cart-' . $this->customer->id . '-items',
                $this->settings->get('cartCacheLifeTime', 20 * 60),
                function () {
                    return $this->orderItemRepository->getCartByCustomer($this->customer);
                });
    }
}
