<?php

namespace App\Contracts\Service\Seller;

interface ImportSellerServiceContract
{
    public function import(array $attributes);
}