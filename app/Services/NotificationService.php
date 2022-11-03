<?php

namespace App\Services;

class NotificationService
{
    /**
     * Handle to mark as read all notification or by specified id by current user session
     *
     * @return void
     */

    public function handleMarkAsRead(): void
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();
    }
}
