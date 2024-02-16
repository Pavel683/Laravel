@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Главная страница</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Супер Сайт!</h1>

@include('main.menu') <!-- Добавить кусок раздела -->


@endsection
