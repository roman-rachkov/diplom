<?php

namespace App\Service\Product;

use App\Contracts\Repository\CompareProductsRepositoryContract;
use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

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

    public function remove(Product $product): bool
    {
        return (bool)rand(0, 1);
    }

    public function get(int $quantity = 3): Collection
    {
        return ComparedProduct::factory()
            ->count($quantity)
            ->make()
            ->sortBy([['id', 'desc']]);
    }

    public function getCount(): int
    {
        return rand(1, 100);
    }
}