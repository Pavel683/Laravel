@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Пользователи</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Пользователи</h1>

<a href="{{ route('users_list', 'only_activ=Y') }}">Только с записями</a>
|
<a href="{{ route('users_list', 'only_activ=N') }}">Без записей</a>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

    <table class="alert alert-warning d-flex flex-column align-items-center border-bottom border">
        <tr>
            <td>ID</td>
            <td>NAME</td>
            <td>FAMILE</td>
        </tr>
        @if($users)
                @foreach($users as $user)
                <tr>
                    <td><a href="{{ route('places', compact('user')) }}">{{ $user->id }}</a></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->second_name }}</td>

                </tr>
                @endforeach
        @endif
    </table>

@endsection
