@extends('mobile.base')

@section('title')
    <title>{{ config('web.title') }}|搜索</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index/search.css') }}"/>
@endsection

@section('body')
    <div id="body">
        <div class="search-input">
            <span class="search-tips">书名或作者</span>
            <input id="key" type="text" name="key" placeholder="请输入想看的^_^"/>
            <span class="search-btn"><a class="btn-green" onclick="makeSearch();">查找</a></span>
        </div>

        <div class="header head-hr">
            <span>搜索结果</span>
        </div>

        <div class="search-result">
            <volist name="result" id="vo" key="k">
                <if condition="$k % 2 eq 0">
                    <a class="chapter-href double-row" href="">
                        <span class="storyName"></span>
                        <span class="author">作者：</span>
                        <div class="float-clean"></div>
                    </a>
                    <else/>
                    <a class="chapter-href single-row" href="">
                        <span class="storyName"></span>
                        <span class="author">作者：</span>
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
            var baseUrl = "";
            var key = $("#key").val();
            console.log("key = " + key);
            window.location.href = baseUrl + "/key/" + key;
        }
    </script>
@endsection