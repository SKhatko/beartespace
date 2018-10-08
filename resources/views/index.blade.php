@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('header')

    @include('layouts.header.top')
    @include('layouts.header.middle')
    @include('layouts.header.bottom')

@endsection

@section('content')

    <div class="app-index">
        @if($randomArtwork && $randomArtwork->image)
            <div class="app-index-banner"
                 style="background-image: url('/imagecache/original{{ $randomArtwork->image_url }}')">

                <div class="banner--fade">

                    <h1 class="banner-title">We sell Art - Join Us</h1>

                    <div class="banner-buttons">
                        <a href="{{ route('artworks') }}" class="el-button el-button--default is-plain">Buy Art</a>
                        <a href="{{ route('auctions') }}" class="el-button el-button--default is-plain">Go to
                            Auctions</a>
                    </div>

                    <div class="banner-info">
                        <span>{{ $randomArtwork->user->name }}</span>
                        <span>{{ $randomArtwork->title }}</span>
                        <span>{{ $randomArtwork->size() }}</span>
                        <span>
                            @foreach($randomArtwork->medium as $medium)
                                {{ trans('medium.' . $medium) && strpos(trans('medium.' . $medium), 'medium') !== false ? $medium : trans('medium.' . $medium)}}
                            @endforeach
                        </span>
                    </div>

                </div>
            </div>
        @endif

        <div class="app--wrapper">

            <div class="app-index-auctions">


                <div class="h2">
                    Next coming auction
                </div>

                <div class="h4">
                    Go to see the next coming auctions
                </div>

                <div class="auctions">

                    <artworks-block artworks_="{{ $auctions }}"></artworks-block>

                    {{--                    Ends {{ date('F jS\. Y', strtotime($auction->auction_end)) }}--}}

                </div>

                <div class="auctions-bottom">
                    <a href="{{ route('auctions') }}"
                       class="auctions-bottom-link el-button el-button--default is-plain">More auctions</a>
                </div>

            </div>
        </div>

        <div class="app--wrapper">

            <div class="app-index-articles">

                <div class="articles">
                    <!-- slides -->
                    @foreach($articles as $article)

                        <a href="{{ route('artwork', $article->id) }}" class="article">
                            @if($article->image)
                                <div class="article-image">
                                    <img src="/imagecache/fit-290{{ $article->image_url }}"
                                         alt="{{ $article->image->name }}">
                                </div>
                            @endif
                            <div class="article-content">
                                <div class="h2">{{ $article->title }}</div>
                                <div class="h5">{{ $article->content }}</div>
                            </div>
                        </a>

                    @endforeach


                </div>

                <div class="articles-bottom">
                    <a href="{{ route('articles') }}"
                       class="articles-bottom-link el-button el-button--default is-plain">More Articles</a>
                </div>

            </div>
        </div>

        <div class="app--wrapper">

            <div class="app-index-artworks">

                <div class="h2">
                    Selected artworks by our curator
                </div>

                <div class="h4">
                    Find here our selected artworks
                </div>

                <div class="artworks">

                    <artworks-block artworks_="{{ $artworks }}"></artworks-block>

                </div>

                <div class="artworks-bottom">
                    <a href="{{ route('selected-artworks') }}"
                       class="artworks-bottom-link el-button el-button--default is-plain">
                        The full selection from our curator</a>
                </div>

            </div>
        </div>


    </div>

@endsection

@section('footer')
    @include('layouts.footer.top')
    @include('layouts.footer.middle')
    @include('layouts.footer.bottom')
@endsection