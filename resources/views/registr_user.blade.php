@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Вход</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Войти</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif


<h2>Авторизация</h2>
<form method="post" action="{{ route('auth_user') }}" >
    @csrf <!--Токен для безопасности-->
    <input type="text" name="id" placeholder="ID">
    <button type="submit" class="btn btn-success">Войти</button>
</form>

@endsection
