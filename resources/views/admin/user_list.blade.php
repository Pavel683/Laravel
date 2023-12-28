@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Пользователи</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('admin.admin_navigation')

<h1>Пользователи</h1>
<a href="{{ route('admin_menu') }}">< Назад</a>
|
{{--<a href="{{ route('users_list', 'only_activ=Y') }}">Только с записями</a>--}}
{{--|--}}
{{--<a href="{{ route('users_list', 'only_activ=N') }}">Без записей</a>--}}

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

<table >
    <tr>
        <td>ID</td>
        <td>USER</td>
        <td>ACTIVE</td>
        <td>RULES</td>
        <td>ACTION</td>
    </tr>
    @if($users)
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->fio }}</td>
                <td>{{ $user->is_active ? "Активен" : "Не активен" }}</td>
                <td>{{ $user->is_admin ? "Админ" : "Пользователь" }}</td>
                <td>
                    @if($user->is_admin)
                        <a style="font-size: 15px" href="{{ route('delAdmin', compact('user')) }}">Сделать пользователем</a>
                    @else
                        <a style="font-size: 15px" href="{{ route('setAdmin', compact('user')) }}">Сделать админом</a>
                    @endif
                    <br>
                    @if($user->is_active)
                        <a style="font-size: 15px" href="{{ route('delActive', compact('user')) }}">Деактивировать учетную запись</a>
                    @else
                        <a style="font-size: 15px" href="{{ route('setActive', compact('user')) }}">Активировать учетную запись</a>
                    @endif

                </td>

            </tr>
        @endforeach
    @endif
</table>

<style>
    table, td, th {
        border-collapse: collapse;
        border: 1px solid #245488;
    }
    table {
        position: center;
        width: 1200px;
    }
    td {
        width: 100px;
        height: 10px;
    }
</style>

@endsection
