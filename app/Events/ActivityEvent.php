<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;

class ActivityEvent extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $eventData;

    public function __construct($eventData)
    {
        $this->eventData = $eventData;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
