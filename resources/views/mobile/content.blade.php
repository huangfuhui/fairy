@extends('mobile.base')

@section('meta')
    <meta name="keywords" content="{{ $book_info['name'] }} 小说"/>
    <meta name="description" content="{{ $book_info['name'] }} 无广告 无弹窗"/>
@endsection

@section('title')
    <title>{{ $book_info['name'] }}|{{ $chapter['current_chapter']['name'] }}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index/content.css') }}"/>
@endsection

@section('head')
    <div class="header">
        <div class="head-nav">
            <span class="home btn-green">
                <a href="{{ route('mobile_index') }}">首页</a>
            </span>
            <span id="head-title">{{ $chapter['current_chapter']['name'] }}</span>
        </div>
    </div>
@endsection

@section('body')
    <div class="page-selector">
        <div class="first-selector-row">
            <span>
                @if(empty($chapter['last_chapter']['id']))
                    <a class="btn-white" href="#">上一章</a>
                @else
                    <a class="btn-white"
                       href="{{ route('mobile_content', ['book_id' => $book_info['id'], 'chapter_id' => $chapter['last_chapter']['id'], 'content_id' => $chapter['last_chapter']['content_id']]) }}">上一章</a>
                @endif
                </span>
            <span>
                    <a class="btn-white" href="{{ route('mobile_book', ['book_id' => $book_info['id']]) }}">目录</a>
                </span>
            <span>
                @if(empty($chapter['next_chapter']['id']))
                    <a class="btn-white" href="#">下一章</a>
                @else
                    <a class="btn-white"
                       href="{{ route('mobile_content', ['book_id' => $book_info['id'], 'chapter_id' => $chapter['next_chapter']['id'], 'content_id' => $chapter['next_chapter']['content_id']]) }}">下一章</a>
                @endif
            </span>
        </div>
    </div>

    <div class="header head-hr"></div>

    <div class="body">
        <div class="chapter-name">
            {{ $chapter['current_chapter']['name'] }}
        </div>

        <div class="content">
            {!! $content !!}
        </div>

        <div class="page-selector">
            <div class="second-selector-row">
                <span>
                    @if(empty($chapter['last_chapter']['id']))
                        <a class="btn-white" href="#">上一章</a>
                    @else
                        <a class="btn-white"
                           href="{{ route('mobile_content', ['book_id' => $book_info['id'], 'chapter_id' => $chapter['last_chapter']['id'], 'content_id' => $chapter['last_chapter']['content_id']]) }}">上一章</a>
                    @endif
                </span>
                <span>
                    <a class="btn-white" href="{{ route('mobile_book', ['book_id' => $book_info['id']]) }}">目录</a>
                </span>
                <span>
                @if(empty($chapter['next_chapter']['id']))
                        <a class="btn-white" href="#">下一章</a>
                    @else
                        <a class="btn-white"
                           href="{{ route('mobile_content', ['book_id' => $book_info['id'], 'chapter_id' => $chapter['next_chapter']['id'], 'content_id' => $chapter['next_chapter']['content_id']]) }}">下一章</a>@endif
                </span>
            </div>
        </div>
    </div>
@endsection

@section('foot')
    <div class="footer">
        <span>{{ config('web.title') }}</span>
    </div>
@endsection