@extends('mobile.base')

@section('meta')
    <meta name="keywords" content="{{ $book_info['name'] }} 小说"/>
    <meta name="description" content="{{ $book_info['name'] }} 无广告 无弹窗"/>
@endsection

@section('title')
    <title>{{ $book_info['name'] }}</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/mobile/book.css') }}"/>
@endsection

@section('body')
    <div id="body" class="body">
        <div class="introduction">
            <div id="story-cover"><img src="{{ asset('img/' . $book_info['cover']) }}"/></div>
            <div id="book-name">{{ $book_info['name'] }}</div>
            <div id="story-info">
                <div>作者：{{ $book_info['author_name'] }}</div>
                <div>类型：{{ $book_info['status'] }}</div>
                <div>状态：{{ $book_info['type_name'] }}</div>
            </div>
            <div class="float-clean"></div>
            <div class="header"></div>
            <div id="story-intro">
                <div>简介：{{ $book_info['profile'] }}</div>
            </div>
        </div>

        <div class="header head-hr">
            <span class="tips">章节目录</span>
            <span class="sort btn-green">
                {{-- 1:正序 2:反序 --}}
                @if(!empty($page_data['sort']) && $page_data['sort'] == 1)
                    <a href="{{ route('mobile_book', ['book_id' => $book_info['id'], 'sort' => -1]) }}">反序</a>
                @else
                    <a href="{{ route('mobile_book', ['book_id' => $book_info['id'], 'sort' => 1]) }}">正序</a>
                @endif
        </span>
        </div>

        <div class="chapter-list">
            @foreach($page_data['data'] as $chapter)
                @if($loop->index %2 == 0)
                    <a class="chapter-href double-row"
                       href="{{ route('mobile_content', ['book_id' => $book_info['id'], 'chapter_id' => $chapter['id'], 'content_id' => $chapter['content_id']]) }}">{{ $chapter['name'] }}</a>
                @else
                    <a class="chapter-href single-row"
                       href="{{ route('mobile_content', ['book_id' => $book_info['id'], 'chapter_id' => $chapter['id'],'content_id' => $chapter['content_id']]) }}">{{ $chapter['name'] }}</a>
                @endif
            @endforeach
        </div>

        @include('common.paginate')
    </div>
@endsection

@section('foot')
    <div class="footer">
        <span>{{ config('web.title') }}</span>
    </div>
@endsection