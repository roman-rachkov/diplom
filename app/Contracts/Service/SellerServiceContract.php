<?php

namespace App\Contracts\Service;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Collection;

interface SellerServiceContract
{
    public function getPopularProducts(Seller $seller): Collection;
}
