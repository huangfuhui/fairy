<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-transform "/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">

    @section('meta')
        <meta name="keywords" content="{{ config('web.meta.keywords') }}"/>
        <meta name="description" content="{{ config('web.meta.description') }}"/>
    @show

    @section('title')
        <title>{{ config('web.title') }}</title>
    @show

    <link rel="stylesheet" href="{{ asset('css/mobile/base.css') }}"/>
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    @yield('css')
    @yield('js')
</head>
<body>
@section('head')
    <div class="header head-nav">
        <span><img class="logo" src="{{ asset('img/logo.png') }}"/></span>
        <span><a class="btn-green home" href="{{ route('mobile_index') }}">首页</a></span>
    </div>
@show

@section('menu')
@show

@yield('body')

@section('foot')
    <div class="footer">
        <span>{{ config('web.title') }}</span>
    </div>
@show

@yield('script')

<script>
    // 保证头部和尾部间隔
    $(document).ready(function () {
            var minHeight = $(window).height() - 100;
            $("#body").attr("style", "min-height: " + minHeight + "px;");
        }
    )
</script>
</body>
</html>