@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Общий рейтинг</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Общий рейтинг</h1>
@include('places_menu')
<br>
<div style="text-align: right" >
    <a href="{{ route('show_ratings', 'json=Y') }}">Список в json</a>
</div>
<div style="text-align: center">
    @if(isset($summ_ratings_places) && isset($places))
        @foreach($summ_ratings_places as $id_place=>$rating_place)
            @foreach($places as $place)
                @if($place->id == $id_place)
                    <div style="color: @if($rating_place > 0) green @elseif($rating_place < 0) red @else gray @endif"><a href="{{ route('place_detail', $place->id) }}">{{ $place->name_place . ' | ' . $place->type->type_name }}</a> {{ $rating_place }}</div><br>
                @endif
            @endforeach
        @endforeach
    @endif
</div>


@endsection
