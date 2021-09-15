<?php

namespace App\Http\Controllers;

use App\Contracts\Repository\FeedbackRepositoryContract;
use App\Http\Requests\CreateFeedbackRequest;
use App\Service\AdminSettingsService;

class FeedbackController extends Controller
{
    public $feedbackRepository;

    public function __construct(FeedbackRepositoryContract $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;

    }
    public function index(AdminSettingsService $adminSettingsService)
    {
        $phone = $adminSettingsService->get('contactPhone');
        $address = $adminSettingsService->get('contactAddress');
        $email = $adminSettingsService->get('contactEmail');

        return view('feedbacks.index', compact('phone', 'address', 'email'));
    }

    public function sendMessage(CreateFeedbackRequest $request)
    {
        $attributes = $request->validated();

        $this->feedbackRepository->create($attributes);

        return redirect(route('feedbacks.index'))->with('success', 'Сообщение отправлено');
    }
}
