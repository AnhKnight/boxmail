<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\UpdateMailSent;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Spatie\Mailcoach\Events\CampaignMailSentEvent;
use Illuminate\Console\Events\ArtisanStarting;

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
        CampaignMailSentEvent::class => [
            UpdateMailSent::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen(ArtisanStarting::class, function($app) {
            if( isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] == 'migrate' ) {
                \DB::statement("SET SESSION sql_require_primary_key=OFF");
            }
        });
    }
}
