@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>{{ $place->name_place }}</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('places_menu')

<div style="text-align: center">

    <div class="nv-box" style="text-align: left">
        Общая оценка за место: <span style="color: @if($ratings['place'] > 0) green @elseif($ratings['place'] < 0) red @else gray @endif">{{ $ratings['place'] }}</span><br>
        Общая оценка за доки: <span style="color: @if($ratings['document'] > 0) green @elseif($ratings['document'] < 0) red @else gray @endif">{{ $ratings['document'] }}</span><br>

        <form action="{{ route('new_rating') }}" method="post">
            Оценить место:
            @csrf
            <input hidden name="object_id" value="{{ $place->id }}">
            <input hidden name="object_type" value="place">
            <button value="like" name="type_rating" type="submit" class="bg-gray-100">👍</button>
            <button value="dislike" name="type_rating" type="submit" class="bg-gray-100">👎</button>
        </form>
    </div>
    <h1>{{ $place->name_place }}</h1><br>
    <h4>{{ $place->type->type_name }}</h4><br>
    <div>Создал: <a href="{{ route('places', compact('user')) }}">{{ $user->fio }}</a></div>
</div>
<a href="{{ route('documents.create', 'place='.$place->id) }}">Добавить фото</a>
<h4 style="color: green">{{ session()->get('success') }}</h4>
<h4 style="color: red">{{ session()->get('destroy') }}</h4>

<div style="text-align: center">
    Документы:
    @if(isset($documents))
        @foreach($documents as $document)
            <div class="nv-box items-center" style="text-align: center">
                <form action="{{ route('new_rating') }}" method="post">

                    <a target="_blank" href="{{ 'C:/PHP/Laravel/chirper/storage/app/'.$document->url }}">Документ</a>
                    @csrf
                    <input hidden name="object_id" value="{{ $document->id }}">
                    <input hidden name="object_type" value="doc">
                    <button value="like" name="type_rating" type="submit" class="bg-gray-100">👍</button>
                    <button value="dislike" name="type_rating" type="submit" class="bg-gray-100">👎</button>
                </form>
                <form method="post" action="{{ route('documents.destroy', compact('document')) }}">
                    @csrf
                    @method('DELETE')
                    <div><button value="del" name="del" type="submit" class="bg-gray-150">Удалить</button></div>
                </form>
            </div>
        @endforeach
    @endif
</div>


@endsection
