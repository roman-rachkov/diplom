<?php

namespace App\Service;

use App\Contracts\Service\SellerServiceContract;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

class SellerService implements SellerServiceContract
{

    public function getPopularProducts(Seller $seller): Collection
    {
        $pricesFromOrderItems = $seller->prices()->with('product')->withCount('orderItems')->orderByDesc('order_items_count')->take(8)->get();

        $products = $pricesFromOrderItems->map(function($price) {
            return $price->product;
        });

        return  $products;
    }
}
