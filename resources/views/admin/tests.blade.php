@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Магазин</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('admin.admin_navigation')

<h1>Тесты</h1>

<p>{{ $formatted }}</p>



@endsection
