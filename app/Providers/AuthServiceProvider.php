<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Receiver;
use App\Models\Station;
use App\Models\Submission;
use App\Models\User;
use App\Policies\GroupPolicy;
use App\Policies\ReceiverPolicy;
use App\Policies\StationPolicy;
use App\Policies\SubmissionPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Station::class => StationPolicy::class,
        User::class => UserPolicy::class,
        Submission::class => SubmissionPolicy::class,
        Receiver::class => ReceiverPolicy::class,
        Group::class => GroupPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
