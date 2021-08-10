<?php

namespace App\Contracts\Seller;

interface ImportSellerServiceContract
{
    public function import(array $attributes);
}