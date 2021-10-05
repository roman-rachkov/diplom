<?php

namespace App\Service\Payment;

use App\Contracts\Repository\PaymentRepositoryContract;
use App\Contracts\Repository\PaymentsServicesRepositoryContract;
use App\Contracts\Service\PaymentServiceContract;
use App\Exceptions\PaymentException;
use App\Models\Payment;
use Faker\Generator;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

abstract class AbstractPaymentService implements PaymentServiceContract
{
    private PaymentRepositoryContract $paymentRepository;

    abstract public function namespace(): string;

    abstract public function render($inputs = null);

    public function __construct(PaymentRepositoryContract $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function pay(int $card, Payment $payment): bool
    {
        app(UrlGenerator::class)->forceRootUrl(request()->server('SERVER_NAME') . ':' . request()->server('SERVER_PORT'));
        try {
            $this->paymentRepository->setStatus($payment->id, 'waiting_for_capture');
            if ($this->validateCard($card)) {
                $url = route('payment.complete');
                $data['payment'] = $payment->id;
                $response = Http::put($url, $data);
                return $response->json('status');
            }
        } catch (PaymentException $exception) {
            $url = route('payment.cancel');
            $data['message'] = $exception->getMessage();
            $data['payment'] = $payment->id;
            $response = Http::put($url, $data);
            return $response->json('status');
        }
        return false;
    }

    public function validateCard(int $card)
    {
        $validator = Validator::make(
            ['card' => $card],
            ['card' => 'digits:8|multiple_of:2|not_regex:/^\d{7}[0]$/i'],
            [
                'digits' => 'Invalid Card Number',
                'multiple_of' => app(Generator::class)->realText(50),
                'not_regex' => app(Generator::class)->realText(50)
            ]
        );
        if ($validator->fails()) {
            throw new PaymentException($validator->getMessageBag()->getMessages()['card'][0]);
        }
        return true;
    }
}
