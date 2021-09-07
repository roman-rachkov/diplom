<?php

namespace App\Service\Product;

use App\Contracts\Service\Product\CompareProductsServiceContract;
use App\Models\ComparedProduct;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class CompareProductsService implements CompareProductsServiceContract
{

    public function add(Product $product): bool
    {
        return  true;
    }

    public function remove(Product $product): bool
    {
        return true;
    }

    public function get(int $quantity = 3): Collection
    {
        return ComparedProduct::factory()->count(5)->make();


//        return ComparedProduct::where('user_id', auth()->id())
//            ->limit($quantity)
//            ->orderByDesc('id')
//            ->get();
    }

    public function getCount(): int
    {
        return ComparedProduct::where('user_id', auth()->id())->count();
    }
}