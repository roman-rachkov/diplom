<?php

namespace App\Contracts\Service;

use App\Models\Customer;

interface CustomerServiceContract
{
    public function getCustomer(): Customer;
}
