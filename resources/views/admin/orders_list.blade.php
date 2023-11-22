@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Заказы</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('admin.admin_navigation')

<h1>Заказы</h1>
<a href="{{ route('admin_menu') }}">< Назад</a>
|
<a href="{{ route('orders.json_list') }}">Список в json</a>

<h4 style="color: green">{{ session()->get('success') }}</h4>
<h4 style="color: red">{{ session()->get('destroy') }}</h4>

<div style="text-align: center">
    @if(isset($orders))
        @foreach($orders as $order)
            <div style="font-size: 25px">
                <!-- Смотрим в том числе и удаленные product()->withTrashed()->first() -->
                <!-- $loop->iteration - Это различные методы директивы blade позволяющие более удобнее пользоваться циклами ($loop) и переменными -->
                <span>{{ $loop->iteration.") " }} Заказ на "{{ $order->product()->withTrashed()->first()->product_name }}" от {{ $order->user->fio}}</span>@if($order->product()->withTrashed()->first()->trashed())<span style="color: red">    Удален!</span>@endif<a href=""></a><br><hr>
            </div>
        @endforeach
    @endif
</div>

{{ $orders->links('vendor.pagination.bootstrap-4') }}

@endsection
