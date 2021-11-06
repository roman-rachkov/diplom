<?php

namespace App\Orchid\Screens\Review;

use App\Models\Review;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ReviewListScreen extends Screen
{
    public $name;
    public  $description;

    public $permission = 'platform.elements.reviews';

    public function __construct()
    {
        $this->name = __('admin.reviews.screen_name');
        $this->description = __('admin.reviews.screen_description');
    }

    public function query(): array
    {
        return [
            'reviews' => Review::filters()->defaultSort('id')->paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [];
    }

    public function layout(): array
    {
        return [
            Layout::table('reviews', [
                TD::make('review', __('admin.reviews.review'))->filter(TD::FILTER_TEXT)->width('50%'),
                TD::make('created_at', __('admin.reviews.created'))
                    ->sort()
                    ->render(function (Review $review) {
                        return $review->created_at;
                    }),
                TD::make('action', __('admin.reviews.action'))->render(function (Review $review) {
                    return ModalToggle::make(__('admin.reviews.edit'))
                        ->modal('editReview')
                        ->method('update')
                        ->modalTitle(__('admin.reviews.edit_review_with') . $review->id)
                        ->asyncParameters([
                            'review' => $review->id,
                        ]);
                })->align(TD::ALIGN_RIGHT),
            ]),
            Layout::modal('editReview',
                Layout::rows([
                    Input::make('review.id')->type('hidden'),
                    TextArea::make('review.review')->required()->title(__('admin.reviews.review'))->rows(5),
                ])
            )->applyButton(__('admin.reviews.edit'))->async('asyncGetReview'),
        ];
    }

    public function asyncGetReview(Review $review) {
        return [
            'review' => $review
        ];
    }

    public function update(Request $request) {
        $review = Review::find($request->input('review.id'))->update($request->review);
        Toast::info(__('admin.reviews.success'));
    }

}
