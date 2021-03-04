<?php

namespace App\Listeners;

use App\Events\SomeonePostedEvent;
use App\Notifications\SomeonePosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SomeonePostedListener
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
     * @param  SomeonePostedEvent  $event
     * @return void
     */
    public function handle(SomeonePostedEvent $event) {
        $event->user->notify(new SomeonePosted(auth()->user()));
    }
}
