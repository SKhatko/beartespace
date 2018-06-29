@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artist</h2>

        <div class="artist">
            <div>
                Artist {{ $artist->name }} <br>
                Dob {{ $artist->dob }} <br>
                Country {{ $artist->country['country_name'] }} <br>
                Gender {{ $artist->gender }} <br>
                Website {{ $artist->website }} <br>
            </div>


            <img src="{{ $artist->photo['url'] }}" alt="" style="max-height: 400px">
        </div>

        <hr>

        @foreach($artist->artworks as $artwork)


            <div class="sculpture">

                <h3><a href="{{ route('artwork', $artwork->id) }}">{{ $artwork->title }}</a></h3>

                <img src="{{ $artwork->images()->first()->name }}" alt="" style="max-width: 400px">

            </div>
        @endforeach

    </div>

@endsection