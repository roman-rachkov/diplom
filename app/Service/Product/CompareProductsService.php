<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\ComparedProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CompareProductsService implements CompareProductsServiceContract
{

    public function add(Product $product)
    {
        ComparedProduct::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id

        ]);
    }

    public function remove(Product $product)
    {
        ComparedProduct::where('user_id',  auth()->id())
            ->where('product_id', $product->id)
            ->first()
            ->delete();

    }

    public function get(int $quantity = 3): Collection
    {
        return ComparedProduct::where('user_id', auth()->id())
            ->limit($quantity)
            ->orderByDesc('id')
            ->get();
    }

    public function getCount(): int
    {
        return ComparedProduct::where('user_id', auth()->id())->count();
    }
}