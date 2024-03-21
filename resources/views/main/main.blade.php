@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Главная страница</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Супер Сайт!</h1>
<div style="max-width: 25vw; height: auto; display: block; margin: 0 auto;">
    <img style="max-width: 100%; height: auto; border-radius: 30px" src="{{ asset('/storage/main.jpg') }}">
</div>
@include('main.menu') <!-- Добавить кусок раздела -->


@endsection
