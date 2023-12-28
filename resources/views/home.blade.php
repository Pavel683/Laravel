@extends('layout', ['user' => isset($user) ? $user : null]) <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
    <title>Главная страница</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
    <h1>Главная</h1>

@if(isset($val) && isset($name))
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        Добрый День
        {{ $name }}! <br>

        Подключение: {{ $val }}
    </div>
@else
    @if(isset($user))
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            Добрый День
            {{ $user->fio }}! <br>

            @env('test')
                <h1>Тестовый макет, не для продуктивноко сайта!</h1>
            @endenv

        </div>
    @else
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
            Пользователь не зарегистрирован
        </div>
    @endif
@endif

@endsection
