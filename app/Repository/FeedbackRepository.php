<?php

namespace App\Repository;

use App\Contracts\Repository\FeedbackRepositoryContract;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Model;

class FeedbackRepository implements FeedbackRepositoryContract
{
    /**
     * @var Feedback
     */
    protected $model;

    /**
     * @param Feedback $model
     */
    public function __construct(Feedback $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model::create($attributes);
    }

}
