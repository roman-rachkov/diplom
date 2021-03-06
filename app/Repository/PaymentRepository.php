<?php

namespace App\Repository;

use App\Contracts\Repository\PaymentRepositoryContract;
use App\Events\ChangePaymentStatus;
use App\Exceptions\PaymentException;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentsService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaymentRepository implements PaymentRepositoryContract
{
    public function add(Order $order, PaymentsService $service): Payment
    {
        return Payment::create([
            'status' => 'pending',
            'payments_service_id' => $service->id,
            'order_id' => $order->id,
        ]);
    }

    public function getPaymentById(int $id): bool|Payment
    {
        try {
            return Payment::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new PaymentException('Payment with \'id ='.$id.'\' not found');
        }
    }

    public function setStatus(int $paymentId, string $status): bool
    {
        $payment = $this->getPaymentById($paymentId);
        $payment->status = $status;
        return $payment->save();
    }

    public function cancel(int $id, string $message)
    {
        $this->setStatus($id, 'canceled');
        $payment = $this->getPaymentById($id);
        $payment->comment = $message;
        event(new ChangePaymentStatus($payment));
        return $payment->save();
    }

    public function complete(int $id)
    {
        $this->setStatus($id, 'succeeded');
        $payment = $this->getPaymentById($id);
        $payment->payed_at = Carbon::now();
        $payment->comment = null;
        event(new ChangePaymentStatus($payment));
        return $payment->save();
    }
}
