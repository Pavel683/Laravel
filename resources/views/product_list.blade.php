@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Магазин</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Магазин</h1>


<h4 style="color: green">{{ session()->get('success') }}</h4>
<h4 style="color: red">{{ session()->get('destroy') }}</h4>

{{--@dump($products)--}}

<div style="text-align: center">
    @if(isset($products))
        @each('item_list', $products, 'product') <!-- можно foreach заменить на each и вывести все в отдельный шаблон, сократив код -->
    @endif
</div>

{{ $products->links('vendor.pagination.bootstrap-4') }}  <!-- // Пагинация (постраничная новигация) -->



@endsection
