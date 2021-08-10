<?php

namespace App\Contracts\Manufacturer;

interface UpdateManufacturerServiceContract
{
    public function update(array $attributes,string $id);
}