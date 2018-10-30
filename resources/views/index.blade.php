@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('header')

    @include('layouts.header.top')
    @include('layouts.header.middle')
    @include('layouts.header.bottom')

@endsection

@section('content')

    <div class="app-index">

        <div class="app--wrapper">

            @if($randomArtwork && $randomArtwork->image)
                <div class="app-index-banner"
                     style="background-image: url('/imagecache/fit-1200{{ $randomArtwork->image_url }}')">

                    <div class="app-index-banner--fade">

                        <h1 class="app-index-banner__title">Art for Everyone</h1>

                        <div class="app-index-banner__buttons">
                            <a href="{{ route('artworks') }}" class="el-button el-button--default is-plain">Buy Art</a>
                            {{--<a href="{{ route('auctions') }}" class="el-button el-button--default is-plain">Go to--}}
                            {{--Auctions</a>--}}
                        </div>

                        <div class="app-index-banner__info">
                            <a href="{{ $randomArtwork->user->url }}">{{ $randomArtwork->user->name }}</a>
                            <a href="{{ $randomArtwork->url }}">{{ $randomArtwork->name }}</a>
                            <a href="{{ '/artwork?artwork-category=' . $randomArtwork->category }}">{{ trans_input('artwork-category.' . $randomArtwork->category) }}</a>
                            {{--<span>--}}
                            {{--@foreach($randomArtwork->medium as $medium)--}}
                            {{--{{ trans_input('medium.' . $medium) }}--}}
                            {{--@endforeach--}}
                            {{--</span>--}}
                        </div>

                    </div>
                </div>
            @endif


            <div class="app-index-artworks">

                <artworks-block artworks_="{{ $auctions }}">
                    <template slot="header">
                        <div class="h2">Our new coming artworks</div>
                        <div class="h4" style="margin-bottom: 30px;">Go to see the new coming artworks</div>
                    </template>
                    <template slot="footer">
                        <a href="{{ route('auctions') }}"
                           class="el-button el-button--default is-plain">More artworks</a>
                    </template>
                </artworks-block>

                {{--                    Ends {{ date('F jS\. Y', strtotime($auction->auction_end)) }}--}}


            </div>

            <div class="app-index-articles">

                <div class="h2">Our Latest Posts and Articles</div>
                <div class="h4">read more</div>

                <div class="articles">
                    @include('partials.articles-block', $articles)
                </div>

                <div class="app-index-articles-bottom">
                    <a href="{{ route('articles') }}" class="el-button el-button--default is-plain">More Articles</a>
                </div>

            </div>

            @if($selectedArtworks->count())
                <div class="app-index-artworks">

                    <artworks-block artworks_="{{ $selectedArtworks }}">
                        <template slot="header">
                            <div class="h2">Selected artworks by our curator</div>
                            <div class="h4" style="margin-bottom: 30px;">Find here our selected artworks</div>
                        </template>
                        <template slot="footer">
                            <a href="{{ route('selected-artworks') }}" class="el-button el-button--default is-plain">
                                The full selection from our curator</a>
                        </template>
                    </artworks-block>

                </div>
            @endif

        </div>


    </div>

@endsection

@section('footer')
    @include('layouts.footer.top')
    @include('layouts.footer.middle')
    @include('layouts.footer.bottom')
@endsection