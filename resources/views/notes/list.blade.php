@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Заметки</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Заметки</h1>
@include('notes.menu')
<hr>

@foreach($notes_in_categories as $category_id => $notes)

    <div>
        <h2 id="category" data-category="{{ $category_id-1 }}">{{ $categories[$category_id-1]->name }}</h2>
        <svg class="hosting-menu-item-arrow" width="12" height="8" viewBox="0 0 12 8">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.989 7a.997.997 0 0 1-.639-.23l-4.99-4a1.002 1.002 0 0 1 .547-1.768.998.998 0 0 1 .73.227L5.99 4.71l4.351-3.32a.998.998 0 0 1 1.407.15 1 1 0 0 1-.14 1.46l-4.99 3.83A.996.996 0 0 1 5.99 7Z" fill="currentColor"></path>
        </svg>
        <div class="item-list note_list_{{ $category_id-1 }}">
            @foreach($notes as $note)
                <div style="padding: 1px; margin: 2px;">
                    <h4><a class="text-decoration-none status-{{ $note->status_id }}" href="{{ route('notes.show', compact('note')) }}">{{ $note->title }}</a></h4>
                </div>
            @endforeach
        </div>
        <hr>
    </div>
@endforeach

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>

    $(document).ready(function (){
        var url = window.location.href;
        var hasParams = url.includes('?');
        if (hasParams){
            var open = url.lastIndexOf('=')
            var category_id = url.substring(open+1)
            var category = category_id - 1;
            $('.note_list_'+category).addClass('open');
        }
    });

    $(document).on('click', 'h2[id="category"]', function () {

        var param = $(this).data('category');
        var category = $('.note_list_'+param);

        if (category.hasClass('open')){
            category.removeClass('open');
        }else {
            category.addClass('open');
        }
    });

</script>
