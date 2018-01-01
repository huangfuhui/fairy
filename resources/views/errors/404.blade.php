@extends('mobile.base')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/errors/404.css') }}"/>
@endsection

@section('body')
    <div id="body">
        <div class="err-msg">
            @if(empty($exception->getMessage()))
                <span>道友!页面正在闭关修炼中...</span>
            @else
                <span>{{ $exception->getMessage() }}</span>
            @endif
        </div>
    </div>
@endsection