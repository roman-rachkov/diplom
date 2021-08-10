<?php

namespace App\Contracts\Manufacturer;

interface CreateManufacturerServiceContract
{
    public function create(array $attributes);
}