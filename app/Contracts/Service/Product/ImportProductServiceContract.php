<?php

namespace App\Contracts\Service\Product;

interface ImportProductServiceContract
{
    public function import(array $attributes);
}