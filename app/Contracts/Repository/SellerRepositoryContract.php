<?php

namespace App\Contracts\Repository;

use Illuminate\Support\Collection;

interface SellerRepositoryContract
{
    public function getAllSellers(): Collection;
}
