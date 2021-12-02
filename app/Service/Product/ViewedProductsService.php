<?php

namespace App\Service\Product;

use App\Contracts\Repository\ViewedProductsRepositoryContract;
use App\Contracts\Service\CustomerServiceContract;
use App\Contracts\Service\Discount\OtherDiscountServiceContract;
use App\Contracts\Service\Product\ViewedProductsServiceContract;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ViewedProductsService implements ViewedProductsServiceContract
{

    public function __construct(
        private CustomerServiceContract $customerService,
        private ViewedProductsRepositoryContract $viewedProductsRepository,
        private OtherDiscountServiceContract $discountService
    )
    {}

    public function add(Product $product): bool
    {

        if ($this->isViewed($product)) {
            $this->remove($product);
        }

        $this->viewedProductsRepository->create([
            'customer_id' => $this->customerService->getCustomer()->id,
            'product_id' => $product->id,
        ]);

        return true;
    }

    public function remove(Product $product): bool
    {
        return $this->customerService->getCustomer()->viewedProducts()->where('product_id', $product->id)->delete();
    }

    public function isViewed(Product $product): bool
    {
        return $this->customerService->getCustomer()->viewedProducts()->where('product_id', $product->id)->count();
    }

    public function getViewed(): Collection
    {
        $customer = $this->customerService->getCustomer();
        $viewedProducts = $this->viewedProductsRepository
            ->allQuery()
            ->with('product')
            ->where('customer_id', $customer->id)
            ->orderByDesc('created_at')
            ->get();

        return $viewedProducts;
    }

    public function getViewedCount(): int
    {
        return $this->getViewed()->count();
    }

    public function getViewedProductsDTOs(int $limit): array
    {
        $viewedProducts = $this->getViewed()->take($limit)->pluck('product');
        return $this->discountService
            ->getProductPriceDiscountDTOs($viewedProducts);

    }
}
