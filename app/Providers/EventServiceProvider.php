<?php

namespace App\Providers;

use App\Events\ProductEvent;
use App\Events\ProductRestoreALLEvent;
use App\Listeners\ProductListener;
use App\Listeners\ProductRestoreALLListener;
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
    protected $listen = [  // Здесь регистрируем для каждого event свои listeners их может быть несколько
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ProductEvent::class => [
            ProductListener::class,
        ],
        ProductRestoreALLEvent::class => [
            ProductRestoreALLListener::class,
        ],

//        'App\Events\ProductRestoreALLEvent' => [        // Так можно автоматически добавить евенты и листнеры
//            'App\Listeners\ProductRestoreALLListener',  // С помощью команды  php artisan event:generate
//        ],

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
