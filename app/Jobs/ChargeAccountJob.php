<?php

namespace App\Jobs;

use App\Http\Controllers\Admin\PaymentPin\PaymentPinController;
use App\Models\PaymentPin\PaymentPin;
use App\Repositories\Admin\PaymentPinRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChargeAccountJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderItems;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderItems)
    {
        $this->orderItems = $orderItems;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model = new PaymentPin();
        $paymentPinRepository = new PaymentPinRepository($model);
        $paymentPin = new PaymentPinController($paymentPinRepository);

        foreach ($this->orderItems as $orderItem) {
            $paymentPin->storeUsingAfterPay($orderItem);
        }
    }
}
