@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artists</h2>

        @foreach($artists as $artist)

            <div class="artist" style="display:flex">
                <div>
                    Artist {{ $artist->name }} <br>
                    Dob {{ $artist->dob }} <br>
                    Country {{ $artist->country['country_name'] }} <br>
                    Gender {{ $artist->gender }} <br>
                    Website {{ $artist->website }} <br>
                </div>


                <img src="{{ $artist->photo }}" alt="" style="max-height: 400px">
            </div>

            <hr>


        @endforeach
    </div>

@endsection