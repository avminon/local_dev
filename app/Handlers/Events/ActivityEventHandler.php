<?php

namespace App\Handlers\Events;

use App\Activity;
use App\Events\ActivityEvent;

class ActivityEventHandler
{
    /**
     * Create the event handler.
     *
     * @return void
     */
    protected $eventData;

    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  FinishLesson  $event
     * @return void
     */
    public function handle(ActivityEvent $event)
    {
        $activity = new Activity;
        $activity->setActivity($event->eventData);
    }
}
