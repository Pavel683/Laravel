@extends('layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Формы</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
    <h1>Формы</h1>

    @if($errors->any())
{{--        {{ dd($errors) }}--}}
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li> <!-- Двойные скобки вывод переменной -->
                @endforeach
            </ul>
        </div>
    @endif

<h2>Запись</h2>
    <form method="post" action="{{ route('forms') }}/form" enctype="multipart/form-data">
        @csrf <!--Токен для безопасности-->
        <input type="text" name="title.main" id="title.main" placeholder="Название" value="{{ old('title.main') }}">
        <input type="email" name="email" id="email" placeholder="email" value="{{ old('email') }}">
        <textarea name="text" id="text" placeholder="Сообщение"></textarea>
        <input type="file" name="file" id="file" value="{{ old('file') }}">
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>

<h2>Регистрация</h2>
    <form method="post" action="/users/form" >
        @csrf <!--Токен для безопасности-->
        <input type="text" name="fist_name" placeholder="Имя" value="{{ old('fist_name') }}">
        <input type="text" name="second_name" placeholder="Фамилия" value="{{ old('second_name') }}">
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>

<h2>Обратная связь</h2>
<h4 style="color: green">{{ session()->get('success') }}</h4>
    <form method="post" action="{{ route('emails.store') }}" >
        @csrf <!--Токен для безопасности-->
        <input type="text" name="email" placeholder="email" value="{{ old('email') }}">
        <textarea name="message" placeholder="Сообщение" value="{{ old('text') }}"></textarea>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>




{{--    <h1>Инфа из переданого элемента</h1>--}}
{{--    @foreach($reviews as $el)--}}
{{--        <div>--}}
{{--            <h3>{{ $el->email }}</h3> <!-- Выводлим поля из объекта -->--}}
{{--        </div>--}}
{{--    @endforeach--}}


@if(isset($news))
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
        <h4>Ваш запрос отправлен!</h4>
        {{ $news }}
    </div>
@endif

@endsection

<script>
    import Input from "../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Input";
    export default {
        components: {Input}
    }
</script>
