<?php

namespace App\Contracts\Service\Category;

interface DestroyCategoryServiceContract
{
    public function destroy(string $id);
}