<?php

namespace App\Repository;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class OrderItemRepository implements OrderItemRepositoryContract
{

    protected Customer $customer;

    /**
     * @param CustomerServiceContract $customerService
     */
    public function __construct(CustomerServiceContract $customerService)
    {
        $this->customer = $customerService->getCustomer();
    }

    public function add(Product $product, int $quantity, Seller $seller = null): bool
    {
        $item = OrderItem::where([
            ['order_id', '=', null],
            ['customer_id', '=', $this->customer->id]
        ])->whereHas('price', fn($query) => $query->where('product_id', $product->id))->firstOrNew();

        if ($item->id !== null) {
            return $this->setQuantity($product, $quantity);
        }

        $params[] = ['product_id', '=', $product->id];
        if ($seller) {
            $params[] = ['seller_id', '=', $seller->id];
        }

        $price = Price::where($params)->inRandomOrder()->first();
        $item->price()->associate($price);
        $item->customer()->associate($this->customer);
        $item->quantity = $quantity;
        return $item->save();
    }

    public function setSeller(Product $product, int $sellerId): bool
    {
        $item = $this->getCartItem($product);
        $price = Price::firstWhere([
            'product_id' => $product->id,
            'seller_id' => $sellerId,
        ]);
        $item->price()->associate($price);
        return $item->save();
    }

    public function setQuantity(Product $product, int $quantity): bool
    {
        $item = $this->getCartItem($product);

        if ($item === null) {
            return false;
        }

        if ($quantity <= 0) {
            return $this->remove($product);
        }

        $item->quantity = $quantity;
        return $item->save();
    }

    public function remove(Product $product): bool
    {
        return $this->getCartItem($product)?->delete();
    }

    public function getCartItem(Product $product): OrderItem
    {
        return OrderItem::whereHas('price', function (Builder $query) use ($product) {
            return $query->where('product_id', $product->id);
        })->where([
            'order_id' => null,
            'customer_id' => $this->customer->id,
        ])->first();
    }

    public function chengeCutomerId(Collection $orderItems, $customerId)
    {
        foreach ($orderItems as $item) {
            $item->update(['customer_id' => $customerId]);
        }
    }

    public function getCartByCustomer(Customer $customer)
    {
        return $customer
            ->items()
            ->where('order_id', null)
            ->with('price.product')
            ->get();
    }

    public function addHistoryPricesAndDiscounts(Order $order, Collection $cartItemsDTOs)
    {
        $cartItemsDTOs->each(function ($cartItemsDTO) use ($order){
           $item = OrderItem::where([
               ['order_id', $order->id],
               ['price_id', $cartItemsDTO->price->id]
           ])->get()->first();
           $item->history_price = $cartItemsDTO->sumPrice;
           $item->history_discount = $cartItemsDTO->sumPricesWithDiscount;
           $item->save();
        });
    }
}
