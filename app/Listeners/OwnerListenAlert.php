<?php

namespace App\Listeners;

use App\Events\Newusersevent;
use App\Mail\MessageOwner;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OwnerListenAlert
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
     * @param  object  $event
     * @return void
     */
    public function handle(Newusersevent  $event)
    {

        //$event->email;
        Mail::to('stephenjason41@gmail.com')->send(new MessageOwner($event->email));
    }
}
