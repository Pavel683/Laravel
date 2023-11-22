<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('cache:clear'); // Добавить вызов других команд
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');
    }
}
