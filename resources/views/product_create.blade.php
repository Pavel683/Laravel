@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Добавить товар</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Добавить товар</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

<div style="text-align: center">
    <form method="post" action="{{ route('products.store') }}">
    @csrf <!--Токен для безопасности-->
        Наименование: <input class="text-field__input" type="text" name="product_name"  value="{{ old('product_name') }}"><br/><br/>
        Стоимость <input class="text-field__input" type="text" name="price"  value="{{ old('prise') }}"><br/>
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
