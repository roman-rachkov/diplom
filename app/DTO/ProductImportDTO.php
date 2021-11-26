<?php

namespace App\DTO;

class ProductImportDTO implements DataTransferObjectInterface
{
    public string $name;
    public string $slug;
    public string $description;
    public string $full_description;
    public int $category_id;
    public int $manufacturer_id;
    public int $seller_id;
    public float $price;
    public bool $limited_edition;

    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        string $name,
        string $slug,
        string $description,
        string $full_description,
        bool   $limited_edition,
        int    $category_id,
        int    $manufacturer_id,
        int    $seller_id,
        float  $price,
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->full_description = $full_description;
        $this->category_id = $category_id;
        $this->manufacturer_id = $manufacturer_id;
        $this->seller_id = $seller_id;
        $this->price = $price;
        $this->limited_edition = $limited_edition;
    }
}