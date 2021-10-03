<?php

namespace App\Service\Payment;

use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\PaymentsServiceRepositoryContract;
use App\Contracts\Service\PaymentServiceContract;
use App\Exceptions\PaymentException;
use App\Models\Order;
use App\Models\Payment;
use Faker\Generator;
use Illuminate\Support\Facades\Http;

abstract class AbstractPaymentService implements PaymentServiceContract
{

    private PaymentRepositoryContract $paymentRepository;
    private PaymentsServiceRepositoryContract $paymentsServiceRepository;
    protected string $class = '\\' . __CLASS__;


    public function __construct(
        PaymentRepositoryContract         $paymentRepository,
        PaymentsServiceRepositoryContract $paymentsServiceRepository
    )
    {
        $this->paymentRepository = $paymentRepository;
        $this->paymentsServiceRepository = $paymentsServiceRepository;
    }

    public function add(Order $order): bool|Payment
    {
        return $this->paymentRepository->add(
            $order,
            $this->paymentsServiceRepository->getPaymentsServiceByService($this->class)
        );
    }

    public function pay(int $card, Order $order): bool
    {
        $payment = $this->add($order);
        if ($payment) {
            try {
                $this->paymentRepository->setStatus($payment->id, 'waiting_for_capture');
                if ($this->validateCard($card)) {
                    $url = route('payment.complete');
                    $data['_token'] = csrf_token();
                    $data['payment'] = $payment->id;
                    $response = Http::post($url, $data);
                    dd($response);
                }
            } catch (PaymentException $exception) {
                $url = route('payment.cancel');
                $data['message'] = $exception->getMessage();
                $data['_token'] = csrf_token();
                $data['payment'] = $payment->id;
                $response = Http::post($url, $data);
                dd($response);
            }
        }
        return false;
    }

    public function validateCard(int $card)
    {
        if (collect(str_split($card, 1))->count() != 8) {
            throw new PaymentException('Invalid Card Number');
        }
        if ($card % 2 != 0 || collect(str_split($card, 1))->last() == 0) {
            throw new PaymentException(app(Generator::class)->realText(10));
        }
        return true;
    }
}
