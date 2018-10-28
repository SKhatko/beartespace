@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0; padding: 0 15px;">
            <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
            <el-breadcrumb-item><a href="/article">Articles</a></el-breadcrumb-item>
            <el-breadcrumb-item>{{ $article->name }}</el-breadcrumb-item>
        </el-breadcrumb>

        <div class="app-article">

            <div class="app-article__sidebar">
                sidebar with other articles
            </div>

            <div class="app-article__article">

                <div class="app-article__article-name">
                    {{ $article->name }}
                </div>

                @if($article->image)
                    <div class="app-article__article-image">
                        <img src="/imagecache/height-500{{ $article->image_url }}" alt="">
                    </div>
                @endif

                <div class="app-article__article-content">
                    {!! $article->content !!}
                </div>

                @include('partials.share')

                @if($article->source)
                    <div class="app-article__article-source">
                        Source: <a href="{{ $article->source_url }}">{{ $article->source }}</a>
                    </div>
                @endif

                @if($article->category)
                    <div class="app-article__article-category">
                        Category: {{ trans_input('article-category.' . $article->category) }}
                    </div>
                @endif

                @if($article->tags && count($article->tags) > 0)

                    <div class="article-tags">
                        Tags:
                        @foreach($article->tags as $tag)
                            {{ $tag }},
                        @endforeach
                    </div>
                @endif


                <div class="app-article__article-author">
                    By <a href="{{ $article->user->url }}">{{ $article->user->name }}</a>
                </div>

                <div class="app-article__article-published">
                    {{--                        Published {{ $article->publish_at->diffForHumans() }}--}}
                </div>

            </div>

        </div>
    </div>

@endsection