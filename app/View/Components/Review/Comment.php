<?php

namespace App\View\Components\Review;

use App\Models\Review;
use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class Comment extends Component
{

    public Review $comment;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Review $comment)
    {
        $this->comment = $comment;
    }

    public function getCommentDate()
    {
        return Carbon::create($this->comment->created_at)
            ->locale(config('app.locale'))
            ->isoFormat('H:mm - D MMMM YYYY');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.review.comment');
    }
}
