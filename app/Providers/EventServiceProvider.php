<?php

namespace App\Providers;

use App\Events\EmailSubscribed;
use App\Events\InquiryCreated;
use App\Listeners\CreateInquiry;
use App\Listeners\RegisterEmail;
use App\Listeners\SendConfirmationNotification;
use App\Listeners\SendNewInquiryNotification;
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
        EmailSubscribed::class => [
            RegisterEmail::class,
            SendConfirmationNotification::class
        ],
        InquiryCreated::class => [
            CreateInquiry::class,
            SendNewInquiryNotification::class,
            SendConfirmationNotification::class
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
    }
}
