@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Мои места</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>Мои места</h1>
@include('places_menu')

<div>
    Фильтр типов: <select name="find_type">
        <option value="0">-</option>
        @foreach($types as $type)
            <option @if($type_id == $type->id) selected @endif value="{{ $type->id }}">{{ $type->type_name }}</option>
        @endforeach
    </select>
</div>

<div style="text-align: center">
    @if(isset($places))
        @foreach($places as $place)
            <a href="{{ route('place_detail', $place->id) }}">{{ $place->name_place . ' | ' . $place->type->type_name }}</a><br>
        @endforeach
    @endif
</div>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script>

    $(document).on('click', 'option', function () {
        var type = $('select[name="find_type"]').val();
        var url = window.location.href;
        const params = {
            type: type,
        };
        const newUrl = addQueryParamsToUrl(url, params);
        window.location.href = newUrl;
    });

    function addQueryParamsToUrl(url, queryParams) {
        // Проверяем, есть ли уже параметры в URL
        let hasParams = url.includes('?');

        // Проходимся по переданным параметрам
        for (const key in queryParams) {
            if (queryParams.hasOwnProperty(key)) {
                const value = queryParams[key];

                // Если URL уже содержит параметры
                if (hasParams) {
                    // Проверяем, есть ли уже такой ключ в URL
                    const regex = new RegExp(`([?&])${key}=.*?(&|$)`, 'i');
                    if (url.match(regex)) {
                        // Если ключ уже существует, заменяем его значение
                        url = url.replace(regex, `$1${key}=${value}$2`);
                    } else {
                        // Если ключ не существует, добавляем его к URL
                        url += `&${key}=${value}`;
                    }
                } else {
                    // Если URL не содержит параметры, добавляем "?" и параметр к URL
                    url += `?${key}=${value}`;
                    hasParams = true;
                }
            }
        }

        return url;
    }

    // const currentUrl = 'https://example.com/page';
    // const queryParams = { param1: 'value1', param2: 'value2', param1: 'value2' };
    //
    // const newUrl = addQueryParamsToUrl(currentUrl, queryParams);
    // console.log(newUrl);


</script>
