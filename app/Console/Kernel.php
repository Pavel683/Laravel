<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule) // Функция которую вызывает крон, которая в свою очередь высывает остальные необходимые методы
    {                                               // Для вызова через консоль php artisan schedule:run

         $schedule->command('inspire')->hourly(); // Каждый час

        $schedule->call(function (){  // Зарегать свой метод, каждую минуту
           Log::critical("DEMON");
        })->everyMinute();

//        $schedule->command('clear:all')->everyMinute(); // Добавить команду артисана в cron

        $schedule->call(new CacheClearConsoleCommand())->everyMinute();  // Вызов отдельного класса, каждый день daily

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
