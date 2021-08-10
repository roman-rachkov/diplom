<?php

namespace App\Contracts\Category;

interface DestroyCategoryServiceContract
{
    public function destroy(string $id);
}