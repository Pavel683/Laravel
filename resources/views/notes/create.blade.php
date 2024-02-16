@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Добавить заметку</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Добавить заметку</h1>

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('notes.index') }}">< Назад</a>
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
    <form enctype="multipart/form-data" method="post" class="login-form" action="{{ route('notes.store') }}">
    @csrf <!--Токен для безопасности-->
        Название:<br>
        <input class="form-control" type="text" name="title" ><br/>

        <div style="margin: 20px; margin-left: -20px" class="d-inline-flex">
            Категория:
            <select class="notes-select" name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            Статус:
            <select class="notes-select" name="status_id">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        Документы<br>
        <input class="form-control" type="file" multiple name="documents[]"><br/>
        Описание/Ключевые слова<br>
        <textarea style="height: 250px" class="form-control" name="dop_note" ></textarea><br/>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Добавить</button>
        </div>
    </form>
</div>


@endsection
