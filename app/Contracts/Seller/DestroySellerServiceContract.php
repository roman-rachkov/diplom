<?php

namespace App\Contracts\Seller;

interface DestroySellerServiceContract
{
    public function destroy(string $id);
}