<?php

namespace App\Contracts\Seller;

interface UpdateSellerServiceContract
{
    public function update(array $attributes, string $id);
}