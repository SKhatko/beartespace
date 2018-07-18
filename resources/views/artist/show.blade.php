@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-artist">

            <div class="artist">
                <div>
                    <div class="artist-image">
                        <img src="{{ $artist->photo->url }}" alt="{{ $artist->photo->name }}">
                    </div>
                    <div class="artist-name">{{ $artist->name }} </div>
                    <div class="artist-dob">{{ $artist->dob }}</div>
                    <div class="artist-country">{{ $artist->country['country_name'] }}</div>
                    <div class="artist-gender">{{ $artist->gender }}</div>
                    <div class="artist-website">{{ $artist->website }}</div>
                </div>

            </div>

            <hr>
        </div>

        <h2>Other artworks</h2>

        @include('partials.artworks', ['artworks' => $artist->artworks])

    </div>

@endsection