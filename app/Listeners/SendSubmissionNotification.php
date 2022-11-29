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
        $penyuluh = User::notify_submission_penyuluh($getSubmission->district_id);

        if ($getSubmission->group->receiver_type === 'Nelayan') {
            Notification::send(User::notify_submission_admin_tangkap(), new SubmissionNotification($event->user));
        } else if ($getSubmission->group->receiver_type === 'Pembudidaya') {
            Notification::send(User::notify_submission_admin_pembudidaya(), new SubmissionNotification($event->user));
        }

        Notification::send($penyuluh, new SubmissionNotification($event->user));
    }
}
