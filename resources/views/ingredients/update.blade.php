@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Редактировать ингредиент</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Редактировать ингредиент</h1>

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('ingredients.show', $ingredient) }}">< Назад</a>
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

<div style="text-align: center">
    <form enctype="multipart/form-data" method="post" class="login-form" action="{{ route('ingredients.update', $ingredient->id) }}">
    @csrf <!--Токен для безопасности-->
        @method('PATCH')
        Название:<br>
        <input class="form-control" type="text" name="name"  value="{{ $ingredient->name }}"><br/>
        Категория:
        <select class="ingredient-select" name="category_id">
            @foreach($ingredient_categories as $ingredient_category)
                <option @if($ingredient_category->id == $ingredient->category_id) selected @endif value="{{ $ingredient_category->id }}">{{ $ingredient_category->name }}</option>
            @endforeach
        </select>
        Фото<br>
        <div style="width: 15vw;">
                @foreach($images as $image)
                    <div id="image_{{ $image->id }}" style="display: flex">
                        <img style="
                            width: 100%;
                            max-width: 400px;
                            height: 100%;
                            margin-right: 5px;
                            margin-bottom: 7px;"
                         src="{{ asset('/storage/'.$image->url) }}">

                        <a id="del" data-photo="{{ $image->id }}" style="margin-top: 20%; font-size: 300%; color: red; opacity: 0.5" class="text-decoration-none" href="javascript:void(0);">X</a>
                        <input type="hidden" name="old_photo[{{ $image->id }}]" hidden value="{{ $image->id }}">
                    </div>
                @endforeach
            </div>
        <input class="form-control" type="file" multiple name="photos[]"><br/>
        Описание:<br>
        <textarea style="height: 100px" class="form-control" name="description" >{{ $ingredient->description }}</textarea><br/>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Обновить</button>
        </div>
    </form>
</div>


    <script>
        $(document).on('click','#del',function() {
            var param = $(this).data('photo');
            console.log(param);
            $('#image_'+param).remove();
        });
    </script>


@endsection
