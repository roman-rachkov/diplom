<?php

namespace App\Contracts\Service\Review;

interface DestroyReviewServiceContract
{
    public function destroy(string $id);
}