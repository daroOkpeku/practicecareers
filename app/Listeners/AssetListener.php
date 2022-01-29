<?php

namespace App\Listeners;

use App\Events\Assetevent;
use App\Mail\Assetmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AssetListener
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
    public function handle(Assetevent $event)
    {
      Mail::to('stephenjason41@gmail.com')->send(new Assetmail($event->Type));
    }
}
