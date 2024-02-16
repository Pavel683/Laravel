@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Ссылки</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Ссылки</h1>
@include('links.menu')
<hr>

    @foreach($links as $link)
        <div style="border: 0.5px solid #000; padding: 15px; border-radius: 10px; margin: 10px;">
            <h4><a href="{{ route('links.show', compact('link')) }}">{{ $link->name }}</a></h4>
            <p><a target="_blank" href="{{ $link->link }}">{{ $link->link }}</a></p>
        </div>
    @endforeach

@endsection
