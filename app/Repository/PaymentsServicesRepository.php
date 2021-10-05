<?php

namespace App\Repository;

use App\Contracts\Repository\PaymentsServicesRepositoryContract;
use App\Models\PaymentsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class PaymentsServicesRepository implements PaymentsServicesRepositoryContract
{

    public function add(string $name, string $namespace)
    {
        return PaymentsService::firstOrCreate([
            'name' => $name,
            'service' => $namespace
        ]);
    }

    public function getPaymentsServicesList(): Collection
    {
        return PaymentsService::all();
    }

    public function getPaymentsServiceById(int $id): bool|PaymentsService
    {
        try {
            return PaymentsService::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    public function getPaymentsServiceByService(string $namespace): bool|PaymentsService
    {
        try {
            return PaymentsService::firstWhere('service', $namespace);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

}
