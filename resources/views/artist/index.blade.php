@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artists</h2>

        @foreach($artists as $artist)

            <a href="{{ route('artist', $artist->id) }}">{{ $artist->name }}</a>
            <div class="artist">
                <div>
                    Artist {{ $artist->name }} <br>
                    Dob {{ $artist->dob }} <br>
                    Country {{ $artist->country['country_name'] }} <br>
                    Gender {{ $artist->gender }} <br>
                    Website {{ $artist->website }} <br>
                </div>

                <img src="{{ $artist->photo->name }}" alt="" style="max-width: 400px">
            </div>

            <hr>


        @endforeach
    </div>

@endsection