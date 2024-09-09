<?php

namespace App\Jobs;

use App\Http\Controllers\Admin\PaymentPin\PaymentPinController;
use App\Models\Order;
use App\Models\OrderItem;
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

    protected $order;
    protected $orderItems;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->orderItems = $order->orderItems;
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

        $orderStatus = Order::STATUS_PAID_AND_COMPLETED;
        foreach ($this->orderItems as $orderItem) {
            $result = $paymentPin->storeUsingAfterPay($orderItem);
            if (!blank($result) && !blank($result['status'])) {
                OrderItem::setStatus($orderItem, $result['status']);
                if ($result['status'] !== OrderItem::STATUS_CHARGED) {
                    $orderStatus = Order::STATUS_PAID_AND_NOT_COMPLETED;
                    Order::setStatus($this->order, Order::STATUS_PAID_AND_NOT_COMPLETED, $result['message'] ? $orderItem->id . ': ' . $result['message'] : null);
                }
            }
        }
        Order::setStatus($this->order, $orderStatus);
    }
}
