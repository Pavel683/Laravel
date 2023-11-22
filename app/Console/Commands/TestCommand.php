<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command {--test=param}';

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
        $arg = $this->argument('command');
        $opt = $this->option('test');

        $ask = $this->ask('You Pidor? Y/N');



        if ($ask == 'Y'){

            $this->info(
                'Что и требовалось доказать'
            );

        }elseif ($ask == 'N'){

            if ($this->confirm("Ты уверен?")) {

                $this->error('

                Кого ты блять обманываешь!
                            ');
            }else{
                $this->info(
                    'Естественно ты не уверен!'
                );
            }

            $this->choice("Выбери кто ты", ['Пидор', 'Пидор', 'Пидор', 'Пидор']);

        }


//        $this->info('Хуинфо');
//        $this->line('Хулайн');
        $this->error('

            Пошел нахуй!
                        ');
    }
}
