<?php

namespace App\Http\Controllers;

use App\Contracts\Service\PaymentsIntegratorServiceContract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(
        Request                           $request,
        PaymentsIntegratorServiceContract $serviceContract
    )
    {
        $card = $request->validate([
            'payment_card' => 'required|regex:/^\d{4} \d{4}$/i'
        ])['payment_card'];
        $card = (int)str_replace(' ', '', $card);
        $order = session()->pull('order');
        $serviceContract->addPayment($card, $order, session()->pull('payService'));

        return view('payment.waiting')->with(compact('order'));
    }

    public function complete(Request $request, PaymentsIntegratorServiceContract $paymentsService)
    {
        $data = $request->validate(['payment' => 'exists:payments,id']);

        $status = $paymentsService->completed($data['payment']);

        return response()->json(['status' => $status]);

    }

    public function cancel(Request $request, PaymentsIntegratorServiceContract $paymentsService)
    {
        $data = $request->validate([
            'payment' => 'exists:payments,id',
            'message' => 'required'
        ]);

        $status = $paymentsService->canceled($data['payment'], $data['message']);

        return response()->json(['status' => $status]);

    }

}
