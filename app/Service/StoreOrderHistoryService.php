<?php

namespace App\Service;

use App\Contracts\Service\StoreOrderHistoryServiceContract;
use App\Exceptions\StoreOrderHistoryServiceException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class StoreOrderHistoryService implements StoreOrderHistoryServiceContract
{
    const ORDER_HISTORY_BASE_KEY = 'order_history|pay_service_id=';

    /**
     * @throws StoreOrderHistoryServiceException
     */
    public function storeHistory(string $orderId, string $paymentServiceId, Collection $cartItemsDTOs)
    {
        $json = $this->getOrderHistoryJsonFromDTOs($orderId, $cartItemsDTOs);

        if ($json === false) throw new StoreOrderHistoryServiceException('Неверный формат данных для сохранения');

        Redis::connection()
            ->set(
                $this->getKey($paymentServiceId),
                $json
            );
    }

    public function removeHistory(string $paymentServiceId)
    {
        Redis::connection()->del($this->getKey($paymentServiceId));
    }

    public function rememberHistory(string $paymentServiceId): Collection
    {
        $json =  Redis::connection()->get($this->getKey($paymentServiceId));

        return collect(json_decode($json, true));
    }

    protected function getKey(string $paymentServiceId): string
    {
        return self::ORDER_HISTORY_BASE_KEY . $paymentServiceId;
    }

    protected function getOrderHistoryJsonFromDTOs($orderId, Collection $dtos): bool|string
    {
        $orderHistory = ['order_id' => $orderId];

        $dtos->each(function ($dto) use ($orderHistory){
            $orderHistory[] = [
                'price_id' => $dto->price->id,
                'history_price' => $dto->sumPrice,
                'history_discount' => $dto->sumPricesWithDiscount
            ];
        });

        return json_encode($orderHistory);
    }
}