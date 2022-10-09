<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Group;
use App\Models\Station;
use App\Models\Receiver;
use App\Models\Submission;
use App\Observers\GroupObserver;
use App\Observers\UserObserver;
use App\Observers\StationObserver;
use App\Observers\ReceiverObserver;
use App\Observers\SubmissionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Station::observe(StationObserver::class);
        User::observe(UserObserver::class);
        Submission::observe(SubmissionObserver::class);
        Receiver::observe(ReceiverObserver::class);
        Group::observe(GroupObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
