<?php

namespace App\Providers;

use App\Events\AssetassEvent;
use App\Events\Assetevent;
use App\Events\Newusersevent;
use App\Events\Vendorevent;
use App\Listeners\AssetassListener;
use App\Listeners\AssetListener;
use App\Listeners\OwnerListenAlert;
use App\Listeners\Vendorlistener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        Newusersevent::class =>[
           OwnerListenAlert::class,
        ],

        Assetevent::class =>[
           AssetListener::class,
        ],

         Vendorevent::class =>[
          Vendorlistener::class,
         ],

            AssetassEvent::class=>[
                AssetassListener::class,
            ],
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
