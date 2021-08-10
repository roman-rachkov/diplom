<?php

namespace App\Contracts\Seller;

interface CreateSellerServiceContract
{
    public function create(array $attributes);
}