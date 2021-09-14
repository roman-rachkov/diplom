<?php

namespace App\Contracts\Repository;

use Illuminate\Database\Eloquent\Model;

interface FeedbackRepositoryContract
{
    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

}
