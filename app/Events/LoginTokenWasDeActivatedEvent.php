<?php

namespace App\Events;

use App\Enums\EAppType;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginTokenWasDeActivatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $loginTokenId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($loginTokenId)
    {
        $this->loginTokenId = $loginTokenId;
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
