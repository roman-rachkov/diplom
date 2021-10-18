<?php

namespace App\Http\Controllers;

use App\Contracts\Service\AddReviewServiceContract;
use App\Contracts\Service\FlashMessageServiceContract;
use App\Http\Requests\ReviewStoreRequest;
use App\Models\Product;

class ReviewsController extends Controller
{
    public function store(
        Product $product,
        ReviewStoreRequest $request,
        AddReviewServiceContract $addReviewService,
        FlashMessageServiceContract $flashMessageService
    )
    {
        if(!$addReviewService->add($product->id, auth()->user(), $request->validated())) {
            $flashMessageService->flash(__('add_review_service.add.on_error'), 'danger');
        }

        return redirect()->route('product.show',$product);
    }
}
