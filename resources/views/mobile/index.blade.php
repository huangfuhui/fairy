@extends('mobile.base')

@section('title')
    <title>小精灵小说|无广告、无弹窗</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mobile/index.css') }}"/>
@endsection

@section('menu')
    <div class="book-type">
        {{-- 循环输出书籍类型，每行四个 --}}
        @foreach ($book_types as $type)
            @if($loop->index % 4 == 0 && $loop->index > 0)
                <br/>
            @endif
            <span><a href="{{ route('mobile_type', ['type' => $loop->index]) }}">{{ $type }}</a></span>
        @endforeach
    </div>
@endsection

@section('body')
    <div id="body">
        {{-- 搜索功能 --}}
        <div class="search-input">
            <span class="search-tips">书名或作者</span>
            <input id="key" type="text" name="key" placeholder="请输入想看的^_^"/>
            <span class="search-btn"><a class="btn-green" onclick="makeSearch();">查找</a></span>
        </div>

        {{-- 推荐榜单 --}}
        <div class="top-click-title">
            <span>推荐榜单</span>
            <div class="float-clean"></div>
        </div>

        <div class="header"></div>

        {{-- 点击榜单 --}}
        <div class="top-click-title">
            <span>点击榜 Top20</span>
            <div class="float-clean"></div>
        </div>

        <div class="header"></div>

        <div class="top-click-list">
            <volist name="topClicks" id="vo" key="k">
                <if condition="$k % 2 eq 0">
                    <a class="chapter-href double-row" href="#">
                        <span class="storyName"></span>
                        <span class="author"></span>
                        <div class="float-clean"></div>
                    </a>
                    <else/>
                    <a class="chapter-href single-row" href="#">
                        <span class="storyName"></span>
                        <span class="author"></span>
                        <div class="float-clean"></div>
                    </a>
                </if>
            </volist>
        </div>

    </div>
@endsection

@section('script')
    <script>
        /**
         * 发起查找
         */
        function makeSearch() {
            var baseUrl = "#";
            var key = $("#key").val();
            console.log("key = " + key);
            window.location.href = baseUrl + "/key/" + key;
        }
    </script>
@endsection