@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Ингредиенты</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Ингредиенты</h1>
@include('ingredients.menu')
<hr>
<div >
    @foreach($ingredients_in_categories as $category_id=>$ingredients)
        <h2 id="category" data-category="{{ $category_id-1 }}">{{ $ingredient_categories[$category_id-1]->name }}</h2>
        <svg class="hosting-menu-item-arrow" width="12" height="8" viewBox="0 0 12 8">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.989 7a.997.997 0 0 1-.639-.23l-4.99-4a1.002 1.002 0 0 1 .547-1.768.998.998 0 0 1 .73.227L5.99 4.71l4.351-3.32a.998.998 0 0 1 1.407.15 1 1 0 0 1-.14 1.46l-4.99 3.83A.996.996 0 0 1 5.99 7Z" fill="currentColor"></path>
        </svg>
        <div class="item-list open ingredient-box ingredient_list_{{ $category_id-1 }}">
            @foreach($ingredients as $ingredient)
                <div id="main" style="padding: 3px; margin: 7px;">
                    <a style="color: #1b1e21;display: flex; flex-direction: column; align-items: center;" class="text-decoration-none" href="{{ route('ingredients.show', compact('ingredient')) }}">
                        @if($ingredient->storage_documents()->first() !== null)
                            <div class="img_list img-list-mobile" style="overflow: hidden;">
                                <img style="width: 100%; height: 100%;object-fit: cover; border-radius: 15px" src="{{ asset('/storage/'.$ingredient->storage_documents()->first()->url) }}">
                            </div>
                        @else
                            <div class="img_list img-list-mobile" style="overflow: hidden;">
                                <img style="width: 100%; height: 100%;object-fit: cover; border-radius: 15px" src="{{ asset('/storage/ingredients.jpg') }}">
                            </div>
                        @endif
                        <div style="max-width: 25vw;text-align: center">
                            <p>{{ $ingredient->name }}</p>
                        </div>
                        <object>
                            <a class="text-decoration-none btn btn-success" style="height: 30px; padding: 2px; font-size: 15px"
                               href="{{ route('cocktails.index', 'search='.$ingredient->name) }}">>>></a>
                        </object>
                    </a>
                </div>
            @endforeach
        </div>
        <hr>
    @endforeach
</div>
{{--<div class="icon" style="--}}
{{--    background-color: rgb(169, 169, 171);--}}
{{--    background-image: url({{ asset('/storage/ingredients.jpg') }});--}}
{{--    width: 20vw;--}}
{{--    height: 20vw;--}}
{{--    border-radius: 23px;--}}
{{--    background-size: auto 103px;--}}
{{--    border: 1px solid rgba(0,0,0,0.1);"></div>--}}
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>
    $(document).on('click', 'h2[id="category"]', function () {

        var param = $(this).data('category');
        var category = $('.ingredient_list_'+param);
        if (category.hasClass('open')){
            category.removeClass('open');
        }else {
            category.addClass('open');
        }
    });
</script>
