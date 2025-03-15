<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PresenceTestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new PresenceChannel('my-channel'); // Ensure consistency with JavaScript
    }

    /**
     * Data to broadcast with the event.
     */
    public function broadcastWith(): array
    {
        return ['message' => $this->message]; // Ensure data is included
    }

    /**
     * Event alias name for broadcasting.
     */
    public function broadcastAs(): string
    {
        return 'PresenceTestEvent';
    }
}
