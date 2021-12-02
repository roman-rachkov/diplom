<?php

namespace App\DTO;

class ProductImportDTO implements DataTransferObjectInterface
{
    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        public string $name,
        public string $slug,
        public string $description,
        public string $full_description,
        public string $image_path,
        public bool   $limited_edition,
        public int    $category_id,
        public int    $manufacturer_id,
        public int    $seller_id,
        public float  $price,
    )
    {
    }
}