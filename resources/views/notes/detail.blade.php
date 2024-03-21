@extends('main.main_layout') <!-- Наследуем все от файла 'layout' -->

@section('name_title') <!-- Куда вставлять инфу в layout -->
<title>Заметка</title>
@endsection

@section('main_content') <!-- Куда вставлять инфу в layout -->
<h1>{{ $note->title }}</h1>

<nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
    <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="{{ route('notes.index', 'no_hidden='.$note->category_id) }}">< Назад</a>
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
    <form enctype="multipart/form-data" method="post" class="login-form" action="{{ route('notes.update', $note->id) }}">
    @csrf <!--Токен для безопасности-->
        @method('PATCH')
        Название:<br>
        <input class="form-control" type="text" name="title" value="{{ $note->title }}" ><br/>

        <div style="margin: 20px; margin-left: -20px" class="d-inline-flex">
            Категория:
            <select class="notes-select" name="category_id">
                @foreach($categories as $category)
                    <option @if($category->id == $note->category_id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            Статус:
            <select class="notes-select" name="status_id">
                @foreach($statuses as $status)
                    <option @if($status->id == $note->status_id) selected @endif value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <br>
        @if(isset($documents[0]))
            Доки:<br>
            @foreach($documents as $document)
                <div id="document_{{ $document->id }}" style="display: inline-block">
                    <a class="text-decoration-none" href="{{ route('download', $document->id) }}" >{{ $document->file_name }}</a>
                    <a id="del" data-document="{{ $document->id }}" style="margin-left: 20px;font-size: 170%; color: red; opacity: 0.5" class="text-decoration-none" href="javascript:void(0);">X</a>
                    <input type="hidden" name="old_document[{{ $document->id }}]" hidden value="{{ $document->id }}">
                </div><br>
            @endforeach
            <br>
        @endif
        Загрузить Документы<br>
        <input class="form-control" type="file" multiple name="documents[]"><br/>
        Описание/Ключевые слова<br>
        <textarea style="height: 250px" class="form-control" name="dop_note" >{{ $note->dop_note }}</textarea><br/>
        <div style="margin-top: 20px">
            <button type="submit" class="btn btn-success">Обновить</button>
        </div>
    </form>
    <form method="post" action="{{ route('notes.destroy', compact('note')) }}">
        @csrf
        @method('DELETE')
        <div><button onclick="return confirm('Удалить заметку?');" style="margin-top: 15px" value="del" name="del" type="submit" class="btn btn-danger">Удалить</button></div>
    </form>
</div>

<script>
    $(document).on('click','#del',function() {
        var param = $(this).data('document');
        console.log(param);
        $('#document_'+param).remove();
    });
</script>


@endsection
