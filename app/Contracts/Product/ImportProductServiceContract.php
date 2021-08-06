<?php

namespace App\Contracts\Product;

interface ImportProductServiceContract
{
    public function import(array $attributes);
}