<?php

namespace App\Service\Cart;

use App\Contracts\Repository\OrderItemRepositoryContract;
use App\Contracts\Service\AdminSettingsServiceContract;
use App\Contracts\Service\Cart\GetCartServiceContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\CartDiscountServiceContract;
use App\Models\Customer;
use Illuminate\Support\Collection;

class GetCartService implements GetCartServiceContract
{
    protected Customer $customer;

    public function __construct(
        protected OrderItemRepositoryContract $repository,
        CustomerServiceContract $customerService,
        protected AdminSettingsServiceContract $settings,
        protected CartDiscountServiceContract $discountService
    )
    {
        $this->customer = $customerService->getCustomer();
    }

    public function getItemsList(): Collection
    {
        return cache()->tags(['cart', 'orderItems'])->remember(
            'cart-' . $this->customer->id . '-items',
            $this->settings->get('cartCacheLifeTime', 20 * 60),
            function () {
                //TODO: проверить что с репо приходят  связи с ценой и продуктом
                return $this->repository->getCartByCustomer($this->customer);
            }
        );
    }

    public function getCartItemsDTOs(): Collection
    {
        return $this->discountService->getCartItemsDTOs(
            $this->getItemsList(),
            $this->getProductsQuantity(),
            $this->getCartCost(),
            $this->customer->id
        );
    }

    public function getProductsQuantity(): int
    {
        return $this->getItemsList()->sum('quantity');
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
        return $this->getItemsList()->sum('sum');
    }
}
