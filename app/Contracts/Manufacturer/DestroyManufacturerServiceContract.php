<?php

namespace App\Contracts\Manufacturer;

interface DestroyManufacturerServiceContract
{
    public function destroy(string $id);
}