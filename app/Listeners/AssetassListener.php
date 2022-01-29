<?php

namespace App\Listeners;

use App\Events\AssetassEvent;
use App\Mail\AssetassignMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AssetassListener
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
    public function handle(AssetassEvent $event)
    {
      Mail::to('stephenjason41@gmail.com')->send(  new AssetassignMail($event->Assetassignid));
    }
}
