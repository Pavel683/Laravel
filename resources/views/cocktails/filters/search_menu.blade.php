
<form method="get" action="{{ route($url) }}" onsubmit="filter_search();return false;"  >
    <div style="
    margin: 15px; display: flex; border: 0.1px solid #000; background-color: #fff;
      border-radius: 7px; padding: 3px;
    ">
        <svg style="margin: 2px;" aria-hidden="true" class="s-input-icon s-input-icon__search svg-icon iconSearch" width="18" height="18" viewBox="0 0 18 18"><path d="m18 16.5-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5ZM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0Z"></path></svg>
        <input id="search" name="search" style="outline:none;" type="text" placeholder="Поиск" value="@if(isset($search)){{ $search }}@endif">
    </div>
</form>

<script>
    function filter_search(){
        var name = $('#search').val()
        var url = window.location.href;
        const params = {
            search: name,
        };
        const newUrl = addQueryParamsToUrl(url, params);
        return window.location.href = newUrl;
    }
</script>
