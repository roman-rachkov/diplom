<?php

namespace App\Contracts\Service\Feedback;

interface CreateFeedbackServiceContract
{
    public function create(array $attributes);
}