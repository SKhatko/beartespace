@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-articles">

            <el-row :gutter="20" class="articles">

                @foreach($articles as $article)
                    <el-col :xs="12" :sm="6" style="margin-bottom: 20px;">
                        <a href="{{ $article->url }}" target="_blank" class="article">
                            <div class="article-image">
                                <img src="/imagecache/fit-290{{ $article->image_url }}" alt="">
                            </div>

                            <div class="article-name">{{ $article->name }}</div>
                        </a>
                    </el-col>

                @endforeach

            </el-row>

            <div class="articles-bottom" style="text-align: center;margin: 50px 0;">

                <el-button><a href="/selection/artwork">See artworks of the week</a></el-button>

                @if($articles->hasMorePages())
                    <el-button><a href="{{  $articles->nextPageUrl() }}">See more Articles</a></el-button>
                @endif
                <el-button><a href="{{ route('artists') }}">Browse Artists</a></el-button>
                <el-button><a href="{{ route('auctions') }}">Go to Auctions</a></el-button>
            </div>

            {{ $articles->links() }}

        </div>


    </div>

@endsection