@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Магазин</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
@include('admin.admin_navigation')

<h1>Магазин</h1>


<a href="{{ route('admin_menu') }}">< Назад</a>
|
<a href="{{ route('products.create') }}">Добавить товар</a>


<h4 style="color: green">{{ session()->get('success') }}</h4>
<h4 style="color: red">{{ session()->get('destroy') }}</h4>

<h4>Доступные продукты:</h4>
<div style="text-align: center">
    @if(isset($products))
        @foreach($products as $product)
            <div class="d-inline-flex">
                <h4>{{ $product->product_name . ' | Цена: ' . $product->price . ' руб' }}</h4>
                <form method="post" action="{{ route('products.destroy', compact('product')) }}">
                    @csrf
                    @method('DELETE')
                    <div style="margin-left: 20px"><button value="del" name="del" type="submit" class="bg-gray-150">Удалить</button></div>
                </form>
            </div>
            <br>
        @endforeach
    @endif

    {{ $products->links('vendor.pagination.bootstrap-4') }}  <!-- // Пагинация (постраничная новигация) -->

</div></br>
@if(count($delete_products) > 0)
    <h4>Удаленные продукты:</h4>
    <div style="text-align: center">
        @if(isset($delete_products))
            @foreach($delete_products as $product)
                <div class="d-inline-flex" style="margin-bottom: 15px">
                    <h4>{{ $product->product_name . ' | Цена: ' . $product->price . ' руб' }}</h4>
                    <div style="margin-left: 20px"><a class="btn btn-success ml-1" href="{{ route('products.restore', $product) }}">Восстановить</a></div>
                </div>
                <br>
            @endforeach
        @endif

    </div></br>

    <div class="d-inline-flex" style="margin-bottom: 15px">
        <a class="btn btn-warning" href="{{ route('products.restore_all') }}">Восстановить все</a>
    </div>
@endif

@endsection
