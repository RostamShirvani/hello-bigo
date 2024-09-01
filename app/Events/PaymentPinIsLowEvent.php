<?php

namespace App\Events;

use App\Enums\EAppType;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentPinIsLowEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $amount;
    public $value;
    public $appType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($amount, $value, $appType = EAppType::BIGO_LIVE)
    {
        $this->amount = $amount;
        $this->value = $value;
        $this->appType = $appType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel[]
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
