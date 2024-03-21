@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Коктейли</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Коктельчики</h1>
@include('cocktails_menu.menu')
<hr>
@if(count($cocktails))
    @foreach($cocktails as $cocktail)
        <div id="main" style="padding: 15px; margin: 10px;">
            <a style="color: #1b1e21; display: flex" class="text-decoration-none" href="{{ route('cocktails_menu_detail', $cocktail->id) }}">
                @if($cocktail->storage_documents()->first() !== null)
                    <div style="max-width: 25vw; height: auto;">
                        <img style="max-width: 100%; height: auto;" src="{{ asset('/storage/'.$cocktail->storage_documents()->first()->url) }}">
                    </div>
                @else
                    <div style="max-width: 25vw; height: auto;">
                        <img style="max-width: 100%; height: auto;" src="{{ asset('/storage/ifNull.webp') }}">
                    </div>
                @endif
                <div style="margin-left: 15px">
                    <h4>{{ $cocktail->name }}</h4>
                    <pre style="white-space: pre-line;font-family: Calibri,sans-serif;font-size: 13px " id="ingredients">
                        {{ $cocktail->ingredients }}
                    </pre>
                </div>
            </a>
        </div>
        <hr>
    @endforeach
@else
    <div id="main" style="padding: 15px; margin: 10px;">
        <h1>Нет такого! Иди нахуй!</h1>
    </div>
    <hr>
@endif
@endsection
