<?php

namespace App\Repository;

use App\Contracts\Repository\PaymentsServiceRepositoryContract;
use App\Models\PaymentsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class PaymentsServiceRepository implements PaymentsServiceRepositoryContract
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

}
