<?php

namespace App\Contracts\Image;

interface DestroyImageServiceContract
{
    public function destroy(string $id);
}