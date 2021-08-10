<?php

namespace App\Contracts\Image;

interface UpdateImageServiceContract
{
    public function update(array $attributes, string $id);
}