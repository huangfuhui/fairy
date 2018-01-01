<link rel="stylesheet" type="text/css" href="{{ asset('css/common/page.css') }}">

<script type="text/javascript" src="{{ asset('js/page.js') }}"></script>

<div id="page" class="page_div"></div>

<script>
    $("#page").paging({
        pageNo: {{ $page_data['current_page'] }},
        totalPage: {{ ceil($page_data['total'] / $page_data['per_page']) }},
        totalSize: {{ $page_data['total'] }},
        callback: function (num) {
            // TODO:分页跳转
        }
    })
</script>