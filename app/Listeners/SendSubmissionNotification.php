<?php

namespace App\Listeners;

use App\Models\Submission;
use App\Models\User;
use App\Notifications\SubmissionNotification;
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
        $getSubmission = Submission::findOrFail($event->user['id']);

        $petugas = User::notify_submission_petugas();
        $penyuluh = User::notify_submission_penyuluh($getSubmission->district_id);


        Notification::send($petugas, new SubmissionNotification($event->user));
        Notification::send($penyuluh, new SubmissionNotification($event->user));
    }
}
