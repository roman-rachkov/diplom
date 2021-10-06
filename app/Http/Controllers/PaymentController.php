<?php

namespace App\Http\Controllers;

use App\Contracts\Service\PaymentsIntegratorServiceContract;
use App\Http\Requests\PaymentFormRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create(
        PaymentFormRequest                $request,
        PaymentsIntegratorServiceContract $serviceContract
    )
    {
        $card = (int)str_replace(' ', '', $request->validated()['payment_card']);
        $order = session()->pull('order');
        try {
            $payment = $serviceContract->addPayment($card, $order, session()->pull('payService'));
        } catch (\Throwable $e) {
            abort($e->getCode(), $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json(['status' => (bool)$payment, 'paymentId' => $payment->id]);
        }
        return view('payment.waiting')->with(compact('order', 'payment'));
    }

    public function complete(Request $request, PaymentsIntegratorServiceContract $paymentsService)
    {
        $data = $request->validate(['payment' => 'exists:payments,id']);

        try {
            $status = $paymentsService->completed($data['payment']);
        } catch (\Throwable $e) {
            abort($e->getCode(), $e->getMessage());
        }
        return response()->json(['status' => $status]);

    }

    public function cancel(Request $request, PaymentsIntegratorServiceContract $paymentsService)
    {
        $data = $request->validate([
            'payment' => 'exists:payments,id',
            'message' => 'required'
        ]);

        try {
            $status = $paymentsService->canceled($data['payment'], $data['message']);
        } catch (\Throwable $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return response()->json(['status' => $status]);

    }

}
