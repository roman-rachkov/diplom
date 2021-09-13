<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFeedbackRequest;
use App\Service\AdminSettingsService;

class FeedbackController extends Controller
{
    public function index(AdminSettingsService $adminSettingsService)
    {
        $phone = $adminSettingsService->get('contactPhone');
        $address = $adminSettingsService->get('contactAddress');
        $email = $adminSettingsService->get('contactEmail');

        return view('feedbacks.index', compact('phone', 'address', 'email'));
    }

    public function sendMessage(CreateFeedbackRequest $request)
    {
        $request->validated();

        $request->flash();

        redirect(route('feedbacks.index'));
    }
}
