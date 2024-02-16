<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Document;
use App\Models\Name;
use App\Models\User;
//use DebugBar\DebugBar;
use App\Models\Place;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Debugbar;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller{


    public function main()
    {

        return view('main.main');

    }


    public function cache_clear()
    {
        Artisan::call('clear:all');
        return redirect()->back();
    }

    public function home()
    {
//        $roure = Route::current(); // Узнать все про маршруты
//        dump($roure);
//        dump(User::findOrfail(Auth::id())->fio);
        if (Auth::check()){
            $user = User::findOrfail(Auth::id());
            return view('home', compact('user'));
        }

        return view('home');
    }

    public function welcome()
    {
        return view('welcome');
    }



    public function user_dashboard($user = null)
    {
        if ($user) {
            $val = config('app.env'); // обращение к переменным конфига
//            $nam = $user;
//            Debugbar::info('param: ' . $val); // Вывод дебага

//            $auth = request()->only('email', 'password'); // Получение конкретных полей из реквеста формы
//            Auth::attempt($auth); // Зарегестрировать пользователя

//              Auth::login($user);  // Авторизация по массиву пользователя

            ///// Через базу
            $nam = Name::findOrfail($user)->fio;

            return view('home', compact('val'))->withName($nam); // Второй параметр 2 варианта передачи переменной через compact('') или withName($nam) где Name имя переменной

        }else{
//            $val = null;
//            $nam = null;
            return view('registr_user');
        }
    }

    public function registr_user(Request $request){
        return redirect(route('profile', $request->id));
//        return redirect('/dashboard_'.$request->id);

    }


    public function index(Request $request){

        // Что за массив такой этот ваш request?

        $request->path(); // Посмотреть путь
        $request->fullUrl(); // Посмотреть порлный путь
        $request->is('index'); // проверить наличие пути


        // Storage

//        Storage::put('test.txt', 'Hello World'); // Сохранить файл
//        Storage::disk('public')->put('test.txt', 'Hello World Huerd'); // Сохранить файл на опред диск
        $content1 = Storage::get('test.txt');  // Получить
        $content2 = Storage::disk('public')->url('test.txt');  // Получить

        dd($content2);


//        dd($request->input('name'));
    }

    public function users(Request $request){

        // Подзапросы типо, есть еще более удобные подзапросы EAGER LOAD Они позволяют уменьшить количество SQL Запросов и есть еще метод load() который позваляет в зависимости от необходимости добавлять подзапросы
        if ($request->query('only_activ') == 'Y'){
            $users = User::has('places')->get();  // Достаем только записи с имеющийся зависимостью
        }elseif ($request->query('only_activ') == 'N'){
            $users = User::doesntHave('places')->get();  // Достаем только записи с имеющийся зависимостью
        }else {
            $users = User::all();
        }
        return view('users', compact('users'));
    }

        public function form(UserRequest $request){

        // Базовая и не оптимальная проверка
//        $this->validate($request, [
//            'fist_name' => 'required|min:2|max:100', //Проверка
//            'second_name' => 'required|min:2|max:100',
//        ]);
        /////////////
            /// Теперь валидация проходит через объект UserRequest в который мы вносим правила

            Name::create($request->all());
            return redirect('/users');
        }


    public function about()
    {
//        $collect = collect([1,25,3,45,6,7,8]); // обьект коллекция/, типо массива
//        $reviews = new Contact();
//        return view('about', ['reviews' => $reviews->all()]); // Передаем данные в шаблон
//        dd(($collect));
        return view('about');

    }

    public function about_form(Request $request) // Функция с входящ парамсами
    {
//        dd($request);
        $valid = $request->validate([
            'email' => 'required|min:4|max:100', //Проверка
            'title_main' => 'required|min:4|max:100',  // Точка заменяется на нижнее тире
        ]);
//        dd($request); // вывод данных

//        echo $request;
        $news = new Collection(); // Коллекции
        $news['title'] = $request->input('title_main'); // Все эти методы равносильны
        $news['email'] = $request->get('email');
        $news['text'] = $request->text;
//        dd($request->method()); // Узнать метод
//        dd($request->file()); // Узнать файл
        $file = $request->file('file');
        if ($file) {
            $file->store('image', 'public');  // Сохранить файл (Какой, Куда(диск))
        }


//        dd($request->file('file'));


        return view('about', compact('news'));

//        $review = new Contact(); //Новая модель созданная для наследования методов от материнского класса
//        $review->email = $request->input('email'); // Получаем данные из поля
//        $review->save(); // Сохраняем в базу
//        return redirect()->route('about'); // Переадресация назад
    }


    public function baza(){


        dd(Auth::user()); // Получить данные авторизованного пользователя

//        session()->put('theme', 'dark'); // Добавить свойство в сессию
//        dd(session()->all()); // Получить сессию
//        dd(session()->get('_token')); // Получить свойство сессии



        // Использование моделей (классов)

//        $users = Name::all();
//        foreach ($users as $user){
//                $registr = [];
//                $registr['name'] = $user->fist_name;
//                $registr['second_name'] = $user->second_name;
//                $registr['email'] = $registr['name'] . $registr['second_name'][0] . '@mail.ru';
//                $registr['password'] = Hash::make($registr['name'] . '123456789');
//
//                $user = User::create($registr);
//                event(new Registered($user));
//        }

//        $user = User::create($registr);
//
//        event(new Registered($user));
//        Auth::login($user);
//        dd();


//        $name_baza = Name::all()->count();
//        $baza_find = Name::find([1,2]);
//        dd($baza_find);

//        $baza_where = Name::where('fist_name', 'like', '%J%')->get();
//        dd($baza_where);

//        $baza_prop = Name::first();
//        $baza_prop = Name::find(2)->second_name;  // Получаем свойство из базы
//        dump($baza_prop);

        /// Добавить в таблицу
//        $data = [
//            'fist_name' => 'Jon',
//            'second_name' => 'Finger',
//        ];
//        Name::create($data);


        /// Самописные Функции поиска
//        $baza_scope = Name::isjon()->get();
//        $baza_scope = Name::findname('Finger')->get();
//        dump($baza_scope);


        // Упрощенное заданное преобразование
//            $baza_scope = Name::isjon()->get();
//            foreach ($baza_scope as $item){
//                dump($item->fio);
//            }


        // Работа с Дата-Временем с помощью CARBON
//            $baza_prop = Name::find(1)->created_at->format('Y.m.d H-i-s');  // Получаем свойство из базы
//            dump($baza_prop);


        // Массовое добавление в базу
//        $places = Place::all()->map->id;
//        foreach ($places as $place){
//            $images = Storage::allFiles('public/'.$place);
//            if ($images) {
//                foreach ($images as $image){
//                    dump($place);
//                    dump($image);
//                    $data = [
//                        'place_id' => $place,
//                        'url' => $image,
//                    ];
//                    Document::create($data);
//                }
//            }
//        }



    }


}
