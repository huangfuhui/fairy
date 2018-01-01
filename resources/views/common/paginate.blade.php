<link rel="stylesheet" type="text/css" href="{{ asset('css/common/page.css') }}">

<script type="text/javascript" src="{{ asset('js/page.js') }}"></script>

<div id="page" class="page_div"></div>

<script>
    $("#page").paging({
        pageNo: {{ $page_data['current_page'] }},
        totalPage: {{ ceil($page_data['total'] / $page_data['per_page']) }},
        totalSize: {{ $page_data['total'] }},
        callback: function (num) {
            var path = "{{ $page_data['path'] }}?";
            var request = getUrlParams();
            request['page'] = num;

            // 拼接url
            for (var item in request) {
                path += item + "=" + request[item] + "&";
            }
            path = path.substring(0, path.length - 1);

            window.location.href = path;
        }
    })

    // 返回请求参数数组
    function getUrlParams() {
        var url = location.search;
        var request = new Object();
        if (url.indexOf("?") != -1) {
            var str = url.substr(1);
            strs = str.split("&");
            for (var i = 0; i < strs.length; i++) {
                var temp = strs[i].split("=");
                request[temp[0]] = (temp[1]);
            }
        }
        return request;
    }
</script>