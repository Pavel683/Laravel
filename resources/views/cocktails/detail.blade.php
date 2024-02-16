@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>{{ $cocktail->name }}</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="javascript:history.back()">< Назад</a>
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('cocktails.edit', $cocktail) }}">Редактировать</a>
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


<form method="post" action="{{ route('add_properties') }}">
    @csrf
    <input hidden name="cocktail_id" value="{{ $cocktail->id }}">
    <div id="mobile" class="hidden">
        <span class="multiselect_box_mobile">Добавить свойства</span><br>
        <select id="multiSelect" multiple name="properties[]">
            @foreach($properties as $property)
                <option name="{{ $property->name }}" class="option_mobile" @if($binding_properties->contains($property->id)) selected @endif value="{{ $property->id }}">{{ $property->name }}</option>
            @endforeach
        </select>
    </div>

    <div id="desktop" class="hidden">
        <span onclick="open_multiselect()" class="multiselect_box_desktop">Добавить свойства</span><br>
        <div class="multiselect">
            <div class="multiselect-options">
                @foreach($properties as $property)
                    <label>
                        <input name="properties[{{ $property->name }}]" type="checkbox" class="option" @if($binding_properties->contains($property->id)) checked @endif
                        value="{{ $property->id }}"> {{ $property->name }}
                    </label><br>
                @endforeach
            </div>
        </div>
    </div><br>
    <button class="btn btn-info" type="submit">Добавить</button>

    <label style="margin-left: 20px">
        <input type="checkbox" disabled @if($cocktail->in_menu) checked @endif>
        @if($cocktail->in_menu)
            <a class="text-decoration-none" href="{{ route('del_in_menu', compact('cocktail')) }}">Удалить из меню</a>
        @else
            <a class="text-decoration-none" href="{{ route('set_in_menu', compact('cocktail')) }}">Добавить в меню</a>
        @endif
    </label>

</form>

<div style="text-align: right">
    <form method="post" action="{{ route('cocktails.destroy', compact('cocktail')) }}">
        @csrf
        @method('DELETE')
        <div><button onclick="return confirm('Удалить коктейль?');" style="margin-top: 15px" value="del" name="del" type="submit" class="btn btn-danger">Удалить</button></div>
    </form>
</div>

<script>

    $(document).ready(function() {
        desktop_line();
        mobile_line();
    });

    $(document).on("change", function(){
        desktop_line();
        mobile_line();
    });

    function desktop_line() {
        var options = $(".option");
        var selectedOptions = "";
        options.each(function (index, option) {
            if ($(option).is(":checked")) {
                var name = option.name.split('[')[1].slice(0, -1);
                selectedOptions += name + ", ";
            }
        });
        if (selectedOptions === "") {
            $(".multiselect_box_desktop").text("Добавить свойства");
        } else {
            $(".multiselect_box_desktop").text(selectedOptions.slice(0, -2));
        }
    }

    function mobile_line() {
        var selectedOptions = "";
        let options = $('#multiSelect').find(':selected');
        options.each(function(index, option) {
            selectedOptions += option.text + ", ";
        });
        if (selectedOptions === "") {
            $(".multiselect_box_mobile").text("Добавить свойства");
        } else {
            $(".multiselect_box_mobile").text(selectedOptions.slice(0, -2));
        }
    }


</script>

@endsection

