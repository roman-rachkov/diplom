<?php

namespace App\Contracts\Repository;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProductRepositoryContract
{
    public function storeReview(Product $product, array $attributes): bool|Model;

    public function find($slug): Product|null;

    public function getAllProducts($curPage): LengthAwarePaginator;

    public function getProductsForCategory($slug, $curPage): LengthAwarePaginator;

    public function getTopProducts(): Collection;

}