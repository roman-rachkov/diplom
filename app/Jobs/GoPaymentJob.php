<?php

namespace App\Jobs;

use App\Contracts\Service\PaymentServiceContract;
use App\Exceptions\PaymentException;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $card;
    private PaymentServiceContract $paymentsService;
    private Payment $payment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $card, Payment $payment, PaymentServiceContract $paymentsService)
    {
        $this->card = $card;
        $this->paymentsService = $paymentsService;
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo $this->paymentsService->pay($this->card, $this->payment);

    }
}
