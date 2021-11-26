<?php

namespace App\DTO;

class ProductImportDTO implements DataTransferObjectInterface
{
    public string $name;
    public string $slug;
    public string $description;
    public string $fullDescription;
    public int $category;
    public int $manufacturer;
    public int $seller;
    public float $price;

    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        string $name,
        string $slug,
        string $description,
        string $fullDescription,
        int $category,
        int $manufacturer,
        int $seller,
        float $price,
    )
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->fullDescription = $fullDescription;
        $this->category = $category;
        $this->manufacturer = $manufacturer;
        $this->seller = $seller;
        $this->price = $price;
    }
}