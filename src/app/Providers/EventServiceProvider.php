<?php

namespace App\Providers;

use App\Events\CloseTicketEvent;
use App\Events\Listeners\Notifications\NewCommentNotification;
use App\Events\Listeners\SetTicketInProgress;
use App\Events\Listeners\Tickets\CloseTicketEventListener;
use App\Events\Listeners\Tickets\UpdateTicketEventListener;
use App\Events\NewComment;
use App\Events\UpdateTicketEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        NewComment::class => [
            SetTicketInProgress::class,
            NewCommentNotification::class
        ],
        UpdateTicketEvent::class => [
            UpdateTicketEventListener::class,
        ],
        CloseTicketEvent::class => [
            UpdateTicketEventListener::class,
            CloseTicketEventListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
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
