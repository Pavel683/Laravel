@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Администрирование</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Администрирование</h1>

@include('admin.admin_navigation')

@endsection
