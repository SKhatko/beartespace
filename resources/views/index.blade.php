@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app-index">
        <div class="app-index-banner"
             style="background-image: url({{ $artwork->images()->first()->url }});">

            <div class="banner--fade">

                <h1 class="banner-title">We sell Art - Join Us</h1>

                <div class="banner-buttons">
                    <a href="{{ route('artworks') }}">Buy Art</a>
                    <a href="{{ route('auctions') }}">Go to Auctions</a>
                </div>

                <div class="banner-info">
                    <span>{{ $artwork->user->name }}</span>
                    <span>{{ $artwork->title }}</span>
                    <span>{{ $artwork->size() }}</span>
                    <span>
                            @foreach($artwork->medium as $medium)
                            {{ trans('medium.' . $medium) && strpos(trans('medium.' . $medium), 'medium') !== false ? $medium : trans('medium.' . $medium)}}
                        @endforeach
                        </span>
                </div>

            </div>
        </div>

        <div class="app-index-auctions">

            <div class="app--wrapper">

                <div class="h2">
                    Next coming auction
                </div>

                <div class="h4">
                    Go to see the next coming auctions
                </div>

                <div class="auctions">

                    @foreach($auctions as $auction)

                        <div class="auction">
                            <a href="{{ route('auction', $auction->id) }}" class="auction-image">
                                <img src="{{ $auction->images->first()->url }}" alt="{{ $auction->images->first()->name }}">
                            </a>

                            <a href="{{ route('auction', $auction->id) }}" class="auction-title">
                                {{ $auction->title }}
                            </a>

                            <div class="auction-artist">
                                {{ $auction->user->name }}
                            </div>

                            <div class="auction-ends">
                                Ends {{ date('F jS\. Y', strtotime($auction->auction_end)) }}
                                {{--Ends August 6th. 2018--}}
                            </div>
                        </div>

                    @endforeach

                </div>

                <div class="auctions-bottom">
                    <a href="{{ route('auctions') }}" class="auctions-bottom-link">More auctions</a>
                </div>

            </div>
        </div>


    </div>

@endsection