@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>{{ $ingredient->name }}</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="javascript:history.back()">< Назад</a>
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('ingredients.edit', $ingredient) }}">Редактировать</a>
</nav>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
            @endforeach
        </ul>
    </div>
@endif

    <h1>{{ $ingredient->name }}</h1>

    <div style="width: 80vw; overflow: hidden;">
        <div class="gallery">
            @foreach($images as $image)
                <img src="{{ asset('/storage/'.$image->url) }}">
            @endforeach
        </div>
    </div>
<br>
    <div>
        <p style="white-space: pre-line;">
            {{ $ingredient->description }}
        </p>
    </div>
<br>

<a class="text-decoration-none btn btn-success" style="height: 30px; padding: 2px; font-size: 15px"
   href="{{ route('cocktails.index', 'search='.$ingredient->name) }}">Все коктейли с ним</a>

<div style="text-align: right">
    <form method="post" action="{{ route('ingredients.destroy', compact('ingredient')) }}">
        @csrf
        @method('DELETE')
        <div><button onclick="return confirm('Удалить ингредиент?');" style="margin-top: 15px" value="del" name="del" type="submit" class="btn btn-danger">Удалить</button></div>
    </form>
</div>

@endsection

