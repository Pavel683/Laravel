@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Создать коктейль</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Создать коктейль</h1>

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="javascript:history.back()">< Назад</a>
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
    <form enctype="multipart/form-data" method="post" class="login-form" action="{{ route('cocktails.store') }}">
    @csrf <!--Токен для безопасности-->
        Название:<br>
        <input class="form-control" type="text" name="name"  value=""><br/>
        Фото<br>
        <input class="form-control" type="file" multiple name="photos[]"><br/>
        Ингредиенты:<br>
        <textarea style="height: 150px" class="form-control" name="ingredients" ></textarea><br/>
        Рецепт:<br>
        <textarea style="height: 100px" class="form-control" name="description" ></textarea><br/>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Добавить</button>
        </div>
    </form>
</div>


@endsection
