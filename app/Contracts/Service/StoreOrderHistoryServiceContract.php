<?php

namespace App\Contracts\Service;

use Illuminate\Support\Collection;

interface StoreOrderHistoryServiceContract
{
    public function storeHistory(string $orderId, string $paymentServiceId, Collection $cartItemsDTOs);

    public function removeHistory(string $paymentServiceId);

    public function rememberHistory(string $paymentServiceId): Collection;
    
}