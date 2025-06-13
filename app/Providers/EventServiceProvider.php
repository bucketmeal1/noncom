<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Observers\PersonnelObserver;
use App\Models\Personnel;

// use App\Observers\EmployeeObserver;

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

    //  protected $observers = [
    //     Employee::class => [EmployeeObserver::class],
    //  ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {   
        Personnel::observe(PersonnelObserver::class);
        User::observe(UserObserver::class);

        //ChecklistToolRelationship::observe(ChecklistToolRelationshipObserver::class);
        // Employee::observe(EmployeeObserver::class);
        // StaffToolRelationship::observe(StaffToolRelationshipObserver::class);
       // MonitoringTool::observe(MonitoringToolObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
