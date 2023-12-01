@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Магазин</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('admin.admin_navigation')

<h1>Тесты</h1>

<form method="post" action="{{ route('unit_tests_services') }}">
@csrf <!--Токен для безопасности-->
    Введите число: <input class="text-field__input" type="text" name="price"  value="{{ old('prise') }}"><br/>
    <div style="margin-top: 20px; margin-bottom: 20px">
        <button type="submit" class="btn btn-success">Отправить</button>
    </div>
</form>

@if(isset($formatted))
    <p>Результат: <input class="text-field__input" disabled type="text" value="{{ $formatted }}"></p>
@endif


@endsection
