<?php

namespace App\Listeners;

use App\Events\FriendRequestReceivedEvent;
use App\Notifications\FriendRequestReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FriendRequestReceivedListener
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
     * @param  FriendRequestReceivedEvent  $event
     * @return void
     */
    public function handle(FriendRequestReceivedEvent $event) {
        $event->user->notify(new FriendRequestReceived(auth()->user()));
    }
}
