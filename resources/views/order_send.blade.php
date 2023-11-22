@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Сделать заказ</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Сделать заказ</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('product_list') }}">< Назад</a>

<div style="text-align: center">
    <h4>Заказ: {{ $product->product_name }} | {{ $product->price }} руб</h4>
    <form method="post" action="{{ route('orders.store') }}">
    @csrf <!--Токен для безопасности-->
        <input type="text" hidden name="seller_id" value="{{ $seller->id }}">
        <input type="text" hidden name="product_id" value="{{ $product->id }}">
        Покупатель: <input class="text-field__input disabled" type="text" disabled name="seller"  value="{{ $seller->name . " " . $seller->second_name }}"><br/><br/>
        E-mail: <input class="text-field__input disabled" type="text" name="email"  value="{{ $seller->email }}"><br/><br/>
        Телефон для связи: <input class="text-field__input" type="text" name="telephone"  value="{{ old('telephone') }}"><br/>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Отправить</button>
        </div>
    </form>
</div>


<style>
    .text-field__input {
        /*display: block;*/
        /*width: 100%;*/
        /*height: calc(2.25rem + 2px);*/
        /*padding: 0.375rem 0.75rem;*/
        font-family: inherit;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #bdbdbd;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>

@endsection
