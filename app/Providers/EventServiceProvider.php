<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\SomeonePostedEvent::class => [
            \App\Listeners\SomeonePostedListener::class,
        ],
        \App\Events\FriendRequestReceivedEvent::class => [
            \App\Listeners\FriendRequestReceivedListener::class,
        ],
        \App\Events\FriendRequestAcceptedEvent::class => [
            \App\Listeners\FriendRequestAcceptedListener::class,
        ],
        \App\Events\NewChatMessageEvent::class => [
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
}
