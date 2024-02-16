<div style="display: flex;" id="mobile" class="hidden">
    <div>
        <span class="multiselect_box_mobile">Фильтры</span><br>
        <select id="multiSelect" multiple name="properties[]">
            @foreach($properties as $property)
                <option name="{{ $property->name }}" class="option_mobile" @if($filter_properties->contains($property->id)) selected @endif value="{{ $property->id }}">{{ $property->name }}</option>
            @endforeach
        </select>
    </div>
    <button onclick="filterBTN_mobile()" style="font-size: 13px; padding: 3px; height: 30px; margin: 3px" type="button" class="btn btn-success little-btn">Отфильтровать</button>
    <button onclick="filterBTN_reset()" style="font-size: 17px; padding: 3px; height: 30px; margin: 3px" type="button" class="btn btn-danger little-btn">X</button>
</div>


<div style="display: flex" id="desktop" class="hidden">
    <div>
        <span style="margin-left: 80px" onclick="open_multiselect()" class="multiselect_box_desktop">Фильтры</span><br>
        <div class="multiselect">
            <div class="multiselect-options">
                @foreach($properties as $property)
                    <label>
                        <input name="properties[{{ $property->name }}]" type="checkbox" class="option" @if($filter_properties->contains($property->id)) checked @endif
                        value="{{ $property->id }}"> {{ $property->name }}
                    </label><br>
                @endforeach
            </div>
        </div>
    </div>
    <button onclick="filterBTN_desktop()" style="font-size: 13px; padding: 3px; height: 30px; margin: 3px" type="button" class="btn btn-success little-btn">Отфильтровать</button>
    <button onclick="filterBTN_reset()" style="font-size: 13px; padding: 3px; height: 30px; margin: 3px" type="button" class="btn btn-danger little-btn">Сбросить</button>
</div><br>

<script>
    function filterBTN_reset(){
        const url = new URL(document.location);
        const searchParams = url.searchParams;
        searchParams.delete("prop");
        searchParams.delete("search");
        window.location.href = url;
    }

    function filterBTN_desktop() {
        var options = $(".option");
        var selectedOptions = "";
        options.each(function (index, option) {
            if ($(option).is(":checked")) {
                var name = option.value;
                selectedOptions += name + ";";
            }
        });
        var url = window.location.href;
        const params = {
            prop: selectedOptions,
        };
        const newUrl = addQueryParamsToUrl(url, params);
        window.location.href = newUrl;
    }


    function filterBTN_mobile() {
        var selectedOptions = "";
        let options = $('#multiSelect').find(':selected');
        options.each(function(index, option) {
            selectedOptions += option.value + ";";
        });
        var url = window.location.href;
        const params = {
            prop: selectedOptions,
        };
        const newUrl = addQueryParamsToUrl(url, params);
        window.location.href = newUrl;
    }
</script>
