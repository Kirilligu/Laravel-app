<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     *
     * @var array
     */
    protected $listen = [
        \App\Events\CommentCreated::class => [
            \App\Listeners\NotifyAdminOfComment::class,
        ],
    ];

    /**
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
