@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artist</h2>


            <div class="artist" style="display:flex">
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

    </div>

@endsection