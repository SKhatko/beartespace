@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-article">

            <div class="article">

                <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                    <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                    <el-breadcrumb-item><a href="/article">Articles</a></el-breadcrumb-item>
                    <el-breadcrumb-item>{{ $article->name }}</el-breadcrumb-item>
                </el-breadcrumb>


                <div class="article-name">
                    {{ $article->name }}
                </div>


                @if($article->image)
                    <div class="article-image">
                        <img src="/imagecache/height-500{{ $article->image_url }}" alt="">
                    </div>
                @endif

                <div class="article--wrapper">

                    <div class="article-content">
                        {!! $article->content !!}
                    </div>


                    @include('partials.share')

                    <div class="article-source">
                        Source: <a href="{{ $article->source_url }}">{{ $article->source }}</a>
                    </div>

                    <div class="article-category">
                        Category: {{ trans_input('article-category.' . $article->category) }}
                    </div>

                    @if($article->tags && count($article->tags) > 0)

                        <div class="article-tags">
                            Tags:
                            @foreach($article->tags as $tag)
                                {{ $tag }},
                            @endforeach
                        </div>
                    @endif


                    <div class="article-author">
                        By <a href="{{ route('people', $article->user->id) }}">{{ $article->user->name }}</a>
                    </div>

                    <div class="article-published">
                        {{--                        Published {{ $article->publish_at->diffForHumans() }}--}}
                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection