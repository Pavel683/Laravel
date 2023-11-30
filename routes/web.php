<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Команда для просмотра всех маршрутов
 * php artisan route:list
 *
 * Создать модель с миграцией
 * php artisan make:model Email --migration
 *
 * Провести миграции
 * php artisan migrate
 *
 * Создать Ресурс контроллер
 * php artisan make:controller EmailsController --resource --model=Email
 *
 * Войти в тинкер, что то типо консольный обработчик
 * php artisan tinker
 *
 * Запустить выполнение очередей
 * php artisan queue:work
 *
 * Запустить тестовую среду для Unit-тестов
 * php vendor/phpunit/phpunit/phpunit
 *
 * Создать свой тест
 * php artisan make:test Test --unit
 *
 */


//Route::get('/', function () {
////    return Inertia::render('Welcome', [
////        'canLogin' => Route::has('login'),
////        'canRegister' => Route::has('register'),
////        'laravelVersion' => Application::VERSION,
////        'phpVersion' => PHP_VERSION,
////    ]);
//    dd(11);
//});
//
//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//require __DIR__.'/auth.php';

Route::get('locale/{locale}', 'App\Http\Controllers\SystemsController@locale')->name('change_locale');

Route::get('/', 'App\Http\Controllers\MainController@home')->name('home'); //->middleware('add_hash'); // Зарегестрировали middleware в \app\Http\Kernel.php

Route::middleware('auth')->group(function () { // Все роуты для которых необходима авторизация

    Route::prefix('admin')->group(function () {
        Route::get('/', 'App\Http\Controllers\AdminController@admin_menu')->name('admin_menu');
        Route::get('/emails/list', 'App\Http\Controllers\AdminController@emails_list')->name('emails_list');
        Route::get('/products/list', 'App\Http\Controllers\ProductsController@product_admin')->name('product_admin');
        Route::get('/tests', 'App\Http\Controllers\AdminController@unit_tests')->name('unit_tests');


        Route::get('cache_clear', function () {  // Вызывать команды артисана через URL
            Artisan::call('cache:clear');
        });

    });
    Route::resource('emails', '\App\Http\Controllers\EmailsController');

    Route::prefix('places')->group(function () {
        Route::get('/', 'App\Http\Controllers\PlacesController@places')->name('places');
        Route::get('/create', 'App\Http\Controllers\PlacesController@create')->name('create_place');
        Route::post('/form', 'App\Http\Controllers\PlacesController@form')->name('check_form')->middleware('check_place');
        Route::get('/place_{id}', 'App\Http\Controllers\PlacesController@detail')->name('place_detail');
//    Route::get('/place_{id}/photos/add', 'App\Http\Controllers\PlacesController@photos_add')->name('photos_add');
//    Route::post('/photos/upload', 'App\Http\Controllers\PlacesController@upload')->name('photos_upload');
        Route::get('/ratings', 'App\Http\Controllers\PlacesController@show_ratings')->name('show_ratings');
        Route::post('/new_rating', 'App\Http\Controllers\PlacesController@new_rating')->name('new_rating');
    });

    Route::get('documents/download', 'App\Http\Controllers\DocumentsController@download'); // Можно подключать свои методы
    Route::resource('documents', 'App\Http\Controllers\DocumentsController');  //  Для каждой сущности можно создавать ресурс контроллеры где все методы уже есть

    Route::get('orders/json_list', 'App\Http\Controllers\OrdersController@json_list')->name('orders.json_list');
    Route::resource('orders', 'App\Http\Controllers\OrdersController');

    Route::get('products/restore/all', 'App\Http\Controllers\ProductsController@restore_all')->name('products.restore_all');
    Route::get('products/restore/{id}', 'App\Http\Controllers\ProductsController@restore')->name('products.restore');
    Route::get('/shop', 'App\Http\Controllers\ProductsController@index')->name('product_list');
    Route::resource('products', 'App\Http\Controllers\ProductsController');



});

Route::middleware('add_hash')->group(function (){ // Для определенной группы

    Route::get('/about', 'App\Http\Controllers\MainController@about')->name('forms'); // Имя маршрута, так удобнее, если сменится url имя останется
    Route::post('/about/form', 'App\Http\Controllers\MainController@about_form');

    Route::get('/users', 'App\Http\Controllers\MainController@users')->name('users_list');
    Route::post('/users/form', 'App\Http\Controllers\MainController@form')->middleware('check_user');

});

Route::get('/user_dashboard_{name?}', 'App\Http\Controllers\MainController@user_dashboard')->name('profile');
Route::post('/registr_user', 'App\Http\Controllers\MainController@registr_user')->name('auth_user');

Route::get('/baza', 'App\Http\Controllers\MainController@baza');
Route::get('/index', 'App\Http\Controllers\MainController@index');
Route::get('/welcome', 'App\Http\Controllers\MainController@welcome');


// Групировка по пространством имен
//Route::prefix('posts')->group(function () { // Объединения в группы по папкам
//    Route::name('post.')->group(function () { // Объединения в группы по одинаковым кускам name
//        Route::get('/create', 'App\Http\Controllers\PostsController@create')->name('create');
//        Route::get('/delete', 'App\Http\Controllers\PostsController@delete')->name('delete');
//    });
//});

//Route::namespace('Posts')->group(function (){ // Объединения в группы по namespace
//
//});

// Но что бы не городить, можно проще. Объединяем в одну группу
Route::group([
    'prefix' => 'posts',
    'name' => 'post.'
], function () {
    include('post.php');  // Подключить все роуты в отдельном файле
});


Route::get('/user/{id}/{name}', function ($id, $name) { // ДИнамические параметры
    return 'ID: '.$id.'<br>'.'NAME: '.$name;
});

Route::get('/category_{name?}', function ($nameCategory = null) { // ДИнамические параметры
    return 'NAME: '.$nameCategory;
});


//Auth::routes();


//Route::get('/login', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});



//Route::get('/login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@create');

//Route::get('/register', 'App\Http\Controllers\Auth\RegisteredUserController@create')
//    ->name('register');
//


//Route::get('/profiel', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//require __DIR__.'/auth.php';

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php'; // Добавляем авторизацию
