@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Добавить ссылку</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>{{ $link->name }}</h1>

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('links.index') }}">< Назад</a>
</nav>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

<div style="text-align: center">
    <form method="post" class="login-form" action="{{ route('links.update', $link->id) }}">
    @csrf <!--Токен для безопасности-->
        @method('PATCH')
        Название:<br>
        <input class="form-control" type="text" name="name"  value="{{ $link->name }}"><br/><br/>
        Ссылка:<br>
        <input class="form-control" type="text" name="link" value="{{ $link->link }}"><br/><br/>
        Описание/Ключевые слова<br>
        <textarea class="form-control" name="description" >{{ $link->description }}</textarea><br/>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Обновить</button>
        </div>
    </form>
</div>


@endsection
