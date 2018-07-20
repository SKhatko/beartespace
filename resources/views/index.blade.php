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
    </div>

@endsection