<?php

namespace App\Contracts\Repository;

use App\Models\PaymentsService;
use Illuminate\Support\Collection;

interface PaymentsServiceRepositoryContract
{
    public function add(string $name, string $namespace);

    public function getPaymentsServicesList(): Collection;

    public function getPaymentsServiceById(int $id): bool | PaymentsService;

    public function getPaymentsServiceByService(string $namespace): bool|PaymentsService;

}
