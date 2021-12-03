<?php

namespace App\Service;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\Contracts\Service\OrderServiceContract;
use App\DTO\CartItemDTO;
use App\Models\Order;
use Illuminate\Support\Collection;

class OrderService implements OrderServiceContract
{
    public function __construct(
        private CartDiscountServiceContract $discountService,
        private OrderItemRepositoryContract $orderItemRepository
    )
    {}

    public function getOrderItemsDTOs(Order $order): Collection
    {
        if ($order->payment?->payed_at != null) {
            return $this->getPaidOrderDTOs($order);
        }

        return $this->getUnpaidOrderDTOs($order);
    }

    public function addHistory(Order $order)
    {
        $dtos = $this->getUnpaidOrderDTOs($order);
        $this->orderItemRepository->addHistoryPricesAndDiscounts($order,$dtos);

    }

    public function getPaidOrderDTOs(Order $order): Collection
    {
        $items = $this->getItems($order);

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

    public function getUnpaidOrderDTOs(Order $order): Collection
    {
        $items = $this->getItems($order);;

        return $this->discountService->getOrderItemsDTOs(
            $items,
            $items->sum('quantity'),
            $items->sum('sum'),
            $order->id
        );
    }

    public function getItems(Order $order): Collection
    {
        return $this->orderItemRepository->getOrderItemsByOrder($order);
    }
}