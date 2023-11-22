<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   // Добавляем свои дириктивы в blade
//        Blade::directive('dump', function ($val){
//            dump($val);
//        });

        Blade::if('env', function ($env){  // С условиями
            return app()->environment($env);
        });

        Blade::directive('user', function (){  // Что то очень криво работает!
            $user_id = Auth::id();
            $user_fio = User::find($user_id);
            return $user_fio->fio . ' (' . $user_fio->email . ')';
        });


        Product::observe(ProductObserver::class);  // Регистрируем свой обсервер класс привязаный к модели


    }
}
