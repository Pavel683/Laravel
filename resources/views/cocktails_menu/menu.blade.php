
<div style="display: flex">
    <div style="left: 0">
        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
            <a class="me-3 py-2 link-body-emphasis text-decoration-none" href="/">< Назад</a>
        </nav>
    </div>
    @include('cocktails.filters.filter_menu')
</div>

@include('cocktails.filters.search_menu', $url = ['url' => 'cocktails_menu'])

