<?php

namespace App\Providers;

use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $view->with('totalNotifications', NotificationService::handleTotalNotification());
            $view->with('notifications', NotificationService::handleUnreadNotification());
        });

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
    }
}
