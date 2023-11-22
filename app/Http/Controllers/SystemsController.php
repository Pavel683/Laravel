<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class SystemsController extends Controller
{
    public function locale($locale){ // Переключение локализации

//        dump(App::getLocale()); // Посмотреть локализацию
        if (in_array($locale, ['ru', 'en'])){
            App::setLocale($locale);
        }
//        dd(App::getLocale());
        return redirect()->back();
    }
}
