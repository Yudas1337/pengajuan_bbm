<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Notification;

class SendSubmissionNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $notify = User::whereHas('roles', function ($query) {
            $query->where('id', 1);
        })->get();

        Notification::send($notify, new LockedClassroomNotification($lockedClassroomEvent->user));
    }
}
