<?php

namespace App\Contracts\Service\Image;

interface UpdateImageServiceContract
{
    public function update(array $attributes, string $id);
}