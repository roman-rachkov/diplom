<?php

namespace App\DTO;

class OrderDTO implements DataTransferObjectInterface
{
    public string $name;
    public string $email;
    public string $phone;
    public string $deliveryType;
    public string $city;
    public string $address;
    public float $totalCost;
    public string $comment;

    public static function create(mixed $args): OrderDTO
    {
        return new static(...$args);
    }

    public function __construct(
        string $name,
        string $email,
        string $phone,
        string $delivery,
        string $city,
        string $address,
        float  $totalCost,
        string $comment = ''
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->deliveryType = $delivery;
        $this->city = $city;
        $this->address = $address;
        $this->totalCost = $totalCost;
        $this->comment = $comment;
    }
}
