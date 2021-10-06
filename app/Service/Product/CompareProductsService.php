<?php

namespace App\Service\Product;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Collection;

class CompareProductsService implements CompareProductsServiceContract
{
    private CompareProductsRepositoryContract $repository;

    public function __construct(CompareProductsRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function add(Product $product, Customer $customer): bool
    {
        return $this->repository->store($product, $customer);
    }

    public function remove(Product $product, Customer $customer): bool
    {
        return $this->repository->delete($product, $customer);
    }

    public function get(Customer $customer, int $quantity = 3): Collection
    {
        return $this->repository->getComparedProducts($customer)
            ->take($quantity)
            ->sortBy([['id', 'desc']]);
    }

    public function getCount(Customer $customer): int
    {
        return $this->repository
            ->getComparedProducts($customer)
            ->count();
    }
}
