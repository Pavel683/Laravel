@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Форма</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Form</h1>
@include('places_menu')


<form method="POST" action="{{ route('documents.update', compact('document')) }}">
    @csrf
    @method('PUT')  <!-- Нужен для методов PUT DELETE и тд -->
    Загрузить: <input type="text" name="document"><br/>
    <div style="margin-top: 20px">
        <button type="submit" class="btn btn-success">Отправить</button>
    </div>
</form>


@endsection
