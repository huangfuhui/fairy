@extends('mobile.base')

@section('meta')
    <meta name="keywords" content="{$introduction['name']} 小说"/>
    <meta name="description" content="{$introduction['name']} 无广告 无弹窗"/>
@endsection

@section('title')
    <title>{$introduction.name}|{$name}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index/content.css') }}"/>
@endsection

@section('head')
    <div class="header">
        <div class="head-nav">
            <span class="home btn-green"><a
                        href="#">首页</a></span>
            <span id="head-title">{$introduction.name}</span>
        </div>
    </div>
@endsection

@section('body')
    <div class="page-selector">
        <div class="first-selector-row">
        <span><a class="btn-white"
                 href="">上一章</a></span>
            <span><a class="btn-white"
                     href="">目录</a></span>
            <span><a class="btn-white"
                     href="">下一章</a></span>
        </div>
    </div>

    <div class="header head-hr"></div>

    <div class="body">
        <div class="chapter-name">
            {$name}
        </div>

        <div class="content">
            {$content}
        </div>

        <div class="page-selector">
            <div class="second-selector-row">
            <span><a class="btn-white"
                     href="">上一章</a></span>
                <span><a class="btn-white"
                         href="">目录</a></span>
                <span><a class="btn-white"
                         href="">下一章</a></span>
            </div>
        </div>
    </div>
@endsection

@section('foot)
    <div class="footer">
        <span>{{ config('web.title') }}</span>
    </div>
@endsection