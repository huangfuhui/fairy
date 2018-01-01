@extends('mobile.base')

@section('title')
    <title>小精灵小说|无广告、无弹窗</title>
@endsection

@section('menu')
    <div class="book-type">
        {{-- 循环输出书籍类型，每行四个 --}}
        @foreach ($book_types as $type)
            @if($loop->index % 4 == 0 && $loop->index > 0)
                <br/>
            @endif
            <span><a href="{{ route('mobile_type', ['type' => $loop->index + 1]) }}">{{ $type }}</a></span>
        @endforeach
    </div>
@endsection

@section('body')
    <div id="body">
        {{-- 特定类型书籍列表 --}}
        <div class="book-list-title">
            <span>小说分类 - {{ $page_data['type_name'] }}</span>
            <div class="float-clean"></div>
        </div>

        <div class="header"></div>

        <div class="book-list">
            @foreach($page_data['data'] as $book)
                @if($loop->index % 2 == 0)
                    <a class="book-href double-row" href="{{ route('mobile_book', ['book_id' => $book['id']]) }}">
                        <span class="name">{{ $book['name'] }}</span>
                        <span class="author">{{ $book['author'] }}</span>
                        <span class="status">{{ $book['status'] }}</span>
                        <div class="float-clean"></div>
                    </a>
                @else
                    <a class="book-href single-row" href="{{ route('mobile_book', ['book_id' => $book['id']]) }}">
                        <span class="name">{{ $book['name'] }}</span>
                        <span class="author">{{ $book['author'] }}</span>
                        <span class="status">{{ $book['status'] }}</span>
                        <div class="float-clean"></div>
                    </a>
                @endif
            @endforeach
        </div>

        @include('common.paginate')
    </div>
@endsection