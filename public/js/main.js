$(document).ready(function getDeviceType() {
    const userAgent = navigator.userAgent.toLowerCase();
    const isMobile = /mobile|iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(userAgent);

    if (isMobile) {
        $('#mobile').removeClass("hidden");
        $('#desktop').remove();
    } else {
        $('#desktop').removeClass("hidden");
        $('#mobile').remove();
    }
});

$(document).mouseup(function (e) {
    var container = $(".multiselect-options");
    if (container.has(e.target).length === 0){
        container.hide();
    }else {
        container.show();
    }
});

function open_multiselect(){
    $(".multiselect-options").toggle();
}

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
