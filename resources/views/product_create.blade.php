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


@endsection
