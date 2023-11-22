@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Создать Место</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Создать Место</h1>
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

@if(strstr($_SERVER['REQUEST_URI'], "err_place"))
    <div class="alert alert-danger">
        Такое место уже есть!
    </div>
@endif

<div style="text-align: center">
    <h4>@lang('places.create_place_form.input')</h4>  <!-- Берем слова в зависимости от локализации приложения -->
    <form method="post" action="{{ route('check_form') }}" >
    @csrf <!--Токен для безопасности-->
        @lang('places.create_place_form.name'): <input type="text" name="name_place"  value="{{ old('name') }}"><br/>
        @lang('places.create_place_form.type'): <select style="margin-top: 20px" name="type_id">
                    <option selected>-</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        @lang('places.create_place_form.creator'): <select style="margin-top: 20px" name="user_created_id">
            <option selected>-</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->fio }}</option>
            @endforeach
        </select>
{{--        <input style="margin-top: 20px" type="text" name="type" value="{{ old('type') }}"><br/>--}}
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">@lang('places.create_place_form.send')</button>
        </div>
    </form>
</div>

@endsection
