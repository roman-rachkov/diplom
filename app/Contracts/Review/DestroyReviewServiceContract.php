<?php

namespace App\Contracts\Review;

interface DestroyReviewServiceContract
{
    public function destroy(string $id);
}