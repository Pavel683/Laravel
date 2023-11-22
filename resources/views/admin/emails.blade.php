@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Сообщения</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('admin.admin_navigation')

<h1>Сообщения</h1>

<a href="{{ route('admin_menu') }}">< Назад</a>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

<table>
    <tr>
        <td>Email</td>
        <td>Текст сообщения</td>
    </tr>
    @if($emails)
        @foreach($emails as $email)
            <tr>
                <td>{{ $email->email }}</td>
                <td>{{ $email->text }}</td>

            </tr>
        @endforeach
    @endif
</table>

    <style>
        table, td, th {
            border-collapse: collapse;
            border: 3px solid #245488;
        }
    </style>


@endsection
