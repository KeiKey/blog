<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InquiryCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    private $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        $request
    ) {
        $this->request = $request;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|null
     */
    public function broadcastOn()
    {
        return null;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }
}
