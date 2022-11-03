<?php

namespace App\Services;

use Illuminate\Http\Request;

class NotificationService
{
    /**
     * Handle to get and take 10 newly notification by current user session
     *
     * @return int
     */

    public static function handleTotalNotification(): int
    {
        return count(auth()->user()->unreadNotifications);
    }

    /**
     * Handle to get and take 10 newly notification by current user session
     *
     * @return object
     */

    public static function handleUnreadNotification(): object
    {
        return auth()->user()->unreadNotifications->take(10);
    }

    /**
     * Handle to mark as read all notification or by specified id by current user session
     *
     * @param Request $request
     * @return void
     */

    public function handleMarkAsRead(Request $request): void
    {
        auth()->user()
            ->unreadNotifications
            ->when($request->id, function ($q) use ($request) {
                return $q->where('id', $request->id);
            })
            ->take(10)
            ->markAsRead();
    }
}
