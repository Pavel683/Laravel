<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:add {name} {second_name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arguments = $this->argument();

        $pass = $this->secret("Введите пароль");
        $confirm_pass = $this->secret("Подтвердите пароль");

        if ($pass == $confirm_pass){
            $new_admin = [
                'name' => $arguments['name'],
                'second_name' => $arguments['second_name'],
                'email' => $arguments['email'],
                'password' => Hash::make($pass),
                'is_admin' => 1,
            ];
            User::create($new_admin);
            $this->info('Админ создан успешно!');
        }else{
            $this->error('Пароли не совпадают!');
        }

    }
}
