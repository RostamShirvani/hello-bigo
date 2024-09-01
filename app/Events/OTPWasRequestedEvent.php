<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OTPWasRequestedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $to;
    public $randomCode;
    public $template;
    public $driver;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($to, $randomCode = null, $template = null, $driver = null)
    {
        if (!$randomCode) {
            $randomCode = rand(1000, 9999);
        }

        if (!$driver) {
            $driver = strtoupper(config('sms.default'));
        }

        if (!$template) {
            $template = 'otp';
        }

        $this->to = $to;
        $this->randomCode = $randomCode;
        $this->driver = $driver;
        $this->template = $template;
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
