@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-articles">

            @include('partials.articles-block', $articles)

            <div class="articles-bottom" style="text-align: center;margin: 50px 0;">

                <el-button><a href="/selection/artwork">See artworks of the week</a></el-button>

                @if($articles->hasMorePages())
                    <el-button><a href="{{  $articles->nextPageUrl() }}">See more Articles</a></el-button>
                @endif
                <el-button><a href="{{ route('people') }}">Browse Artists</a></el-button>
                <el-button><a href="{{ route('auctions') }}">Go to Auctions</a></el-button>
            </div>

            {{ $articles->links() }}

        </div>


    </div>

@endsection