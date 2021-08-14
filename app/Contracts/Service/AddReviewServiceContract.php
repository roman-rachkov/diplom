<?php

namespace App\Contracts\Service;

interface AddReviewServiceContract
{
    public function add($product, array $attributes);
}