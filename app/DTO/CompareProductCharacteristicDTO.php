<?php

namespace App\DTO;

class CompareProductCharacteristicDTO implements DataTransferObjectInterface
{
    public string $name;
    public ?string $measure;
    public bool $isValuesEqual;
    public array $values;


    public static function create(mixed $args): DataTransferObjectInterface
    {
        return new static(...$args);
    }

    public function __construct(
        string $name,
        ?string $measure,
        bool $isValuesEqual,
        array $values
    )
    {
        $this->name = $name;
        $this->measure = $measure;
        $this->isValuesEqual = $isValuesEqual;
        $this->values = $values;

    }
}