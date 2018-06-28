@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artists</h2>

        @foreach($artists as $artist)

            <div class="artist">
                Artist {{ $artist->name }} <br>
                Dob {{ $artist->dob }} <br>
                Country {{ $artist->country['country_name'] }} <br>
                Gender {{ $artist->gender }} <br>
                Website {{ $artist->website }} <br>

                <img src="{{ $artist->photo }}" alt="">
            </div>


        @endforeach
    </div>

@endsection