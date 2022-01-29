<?php

namespace App\Listeners;

use App\Events\Vendorevent;
use App\Mail\MailVendor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class Vendorlistener
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
    public function handle(Vendorevent $event)
    {
        Mail::to("stephenjason41@gmail.com")->send(new MailVendor($event->Name));
    }
}
