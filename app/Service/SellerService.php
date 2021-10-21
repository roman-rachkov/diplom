<?php

namespace App\Service;

use App\Contracts\Service\SellerServiceContract;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

class SellerService implements SellerServiceContract
{

    public function getPopularProductsFrom(Seller $seller): Collection
    {
        return $seller
                ->prices()
                ->with('product')
                ->withCount('orderItems')
                ->orderByDesc('order_items_count')
                ->get()
                ->map(function($price) {
                        return $price->product;
                    })
                ->take(10);
    }
}
