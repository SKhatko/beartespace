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

            {{--<div class="app-article__sidebar">--}}
            {{--sidebar with other articles--}}
            {{--</div>--}}

            <div class="app-article__article">

                @if($article->category)
                    <div class="app-article__article-category">
                        {{ trans_input('article-category.' . $article->category) }}
                    </div>
                @endif

                <div class="app-article__article-name">
                    {{ $article->name }}
                </div>


                @if($article->source)
                    <div class="app-article__article-source">
                        Source: <a href="{{ $article->source_url }}">{{ $article->source }}</a>
                    </div>
                @else
                    <div class="app-article__article-author">
                        <a href="{{ $article->user->url }}">{{ $article->user->name }}</a> *
                        <span class="app-article__article-published">{{ $article->created_at->format('M d Y') }}</span>
                    </div>
                @endif

                @if($article->image)
                    <div class="app-article__article-image">
                        <img src="/imagecache/width-700{{ $article->image_url }}" alt="">
                    </div>
                @endif

                <div class="app-article__article-content">
                    {!! $article->content !!}
                </div>


                @if($article->tags && count($article->tags) > 0)

                    <div class="article-tags">
                        Tags:
                        @foreach($article->tags as $tag)
                            <b>#{{ $tag }}</b>,
                        @endforeach
                    </div>
                @endif

                @include('partials.share')

            </div>

            <div class="app-article-articles">
                @include('partials.articles-block', $articles)
            </div>

        </div>
    </div>

@endsection