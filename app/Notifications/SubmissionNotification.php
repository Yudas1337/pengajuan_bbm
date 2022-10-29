<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubmissionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param array $user
     *
     * @return void
     */
    public function __construct(array $user)
    {
        $user['message'] = $user['name'] . " baru saja mengajukan kelas dengan judul " . $user['message'];
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->user['id'],
            'name' => $this->user['name'],
            'type' => $this->user['type'],
            'message' => $this->user['message']
        ];
    }
}
