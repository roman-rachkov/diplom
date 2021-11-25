<?php

namespace App\DTO;

class ProductImportDTO implements DataTransferObjectInterface
{
    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct()
    {
        //TODO: Write DTO object
    }
}