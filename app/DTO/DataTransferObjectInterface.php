<?php

namespace App\DTO;

interface DataTransferObjectInterface
{
    public static function create(mixed $args): DataTransferObjectInterface;
}
