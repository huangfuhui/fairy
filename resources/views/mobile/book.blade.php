@extends('mobile.base')

@section('meta')
    <meta name="keywords" content="{$introduction['name']} 小说"/>
    <meta name="description" content="{$introduction['name']} 无广告 无弹窗"/>
@endsection

@section('title')
    <title>{$introduction.name}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mobile/book.css') }}"/>
@endsection

@section('body')
    <div id="body" class="body">
        <div class="introduction">
            <div id="story-cover"><img src="#"/></div>
            <div id="story-info">
                <div>作者：</div>
                <div>类型：</div>
                <div>状态：</div>
            </div>
            <div class="float-clean"></div>
            <div class="header"></div>
            <div id="story-intro">
                <div>简介：</div>
            </div>
        </div>

        <div class="header head-hr">
            <span class="tips">章节目录</span>
            <span class="sort btn-green">
            <if condition="$orderTag eq -1">
                <a href="#">正序</a>
                <else/>
                <a href="#">反序</a>
            </if>
        </span>
        </div>

        <div class="chapter-list">
            <volist name="chapterList" id="vo" key="k">
                <if condition="$k % 2 eq 0">
                    <a class="chapter-href double-row" href="#"></a>
                    <else/>
                    <a class="chapter-href single-row" href="#"></a>
                </if>
            </volist>
        </div>
    </div>
@endsection

@section('foot')
    <div class="footer">
        <span>{{ config('web.title') }}</span>
    </div>
@endsection