<?php

namespace App\Jobs;

use App\Contracts\Service\PaymentServiceContract;
use App\Exceptions\PaymentException;
use App\Models\Order;
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
    private Order $order;
    private PaymentServiceContract $paymentsService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $card, Order $order, PaymentServiceContract $paymentsService)
    {
        $this->card = $card;
        $this->order = $order;
        $this->paymentsService = $paymentsService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->paymentsService->pay($this->card, $this->order);
    }
}
