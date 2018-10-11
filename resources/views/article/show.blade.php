@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-article">

            <div class="article">

                <div class="article-image">
                    <img src="/imagecache/original{{ $article->image_url }}" alt="">
                </div>

                <div class="article-name">
                    {{ $article->name }}
                </div>

                <div class="article-content">
                    {!! $article->content !!}
                </div>

            </div>

        </div>

    </div>

@endsection