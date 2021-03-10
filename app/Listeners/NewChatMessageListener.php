<?php

namespace App\Listeners;

use App\Events\NewChatMessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewChatMessageListener
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
     * @param  NewChatMessageEvent  $event
     * @return void
     */
    public function handle(NewChatMessageEvent $event)
    {
        //
    }
}
