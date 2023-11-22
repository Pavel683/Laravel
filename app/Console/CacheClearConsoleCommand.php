<?php


namespace App\Console;



use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheClearConsoleCommand
{
    public function __invoke()  // Класс для вызова в Schedule и потом уже в кроне
    {
        // TODO: Implement __invoke() method.

        Log::critical("DEMON IN INVOKE");
        Cache::flush();  // Очистить весь кэш

    }
}
