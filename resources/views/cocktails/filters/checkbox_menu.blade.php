<div style="margin: 15px">
    <label>
        <input name="in_menu" type="checkbox" onchange="filterBTN_in_menu(this)" @if($in_menu === true) checked @endif>
        В меню
    </label>
</div>

<script>

    function filterBTN_in_menu(el){
        var url = window.location.href;
        const params = {
            menu: el.checked,
        };
        const newUrl = addQueryParamsToUrl(url, params);
        window.location.href = newUrl;
    }
</script>
