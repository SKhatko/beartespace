@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Paintings</h2>

        @foreach($paintings as $painting)

            <a href="{{ route('artwork', $painting->id) }}">{{ $painting->title }}</a>


                <div>
                    Autor {{ $painting->user['name'] }} <br>
                    Country {{ $painting->user->country['country_name'] }} <br>

                </div>



            <hr>

        @endforeach
    </div>

@endsection