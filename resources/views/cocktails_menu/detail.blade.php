@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>{{ $cocktail->name }}</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="javascript:history.back()">< Назад</a>
</nav>

    <h1>{{ $cocktail->name }}</h1>

    <p>
        @foreach($binding_properties as $binding_property)
            {{ $binding_property->name . ' /' }}
        @endforeach
    </p>
    <div style="width: 80vw; overflow: hidden;">
        <div class="gallery">
            @foreach($images as $image)
                <img src="{{ asset('/storage/'.$image->url) }}">
            @endforeach
        </div>
    </div>
<br>
    <div>
        <pre style="white-space: pre-line;font-family: Calibri,sans-serif;font-size: 16px " id="ingredients">
            {{ $cocktail->ingredients }}
        </pre>
        <p style="white-space: pre-line;">
            {{ $cocktail->description }}
        </p>
    </div>
<br>

@endsection

