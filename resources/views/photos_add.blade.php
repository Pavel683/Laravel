@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Добавить фото</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Добавить фото</h1>
@include('places_menu')

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
    <h4>Выберите фото</h4>
    <form method="post" action="{{ route('documents.store') }}" enctype="multipart/form-data">
        @csrf <!--Токен для безопасности-->
        Загрузить: <input type="file" name="file"  value="{{ old('file') }}"><br/>
        Место: <select style="margin-top: 20px" name="place_id">
                <option>-</option>
            @foreach($places as $place)
                <option @if($place_id == $place->id) selected @endif value="{{ $place->id }}">{{ $place->name_place . ' | ' . $place->type->type_name }}</option>
            @endforeach
        </select>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Отправить</button>
        </div>
    </form>
</div>

@endsection

