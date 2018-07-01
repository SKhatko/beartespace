@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Paintings</h2>

        @foreach($paintings as $painting)
            <div class="app-content-artwork">

                <a href="{{ route('artwork', $painting->id) }}" class="app-content-artwork__link">
                    <img src="{{ $painting->images()->first()->name }}" alt="" style="max-width: 900px">

                    <h3>{{ $painting->title }}</h3>
                </a>

                <div>
                    Autor {{ $painting->user['name'] }} <br>
                    Country {{ $painting->user->country['country_name'] }} <br>

                </div>
            </div>


        @endforeach
    </div>

@endsection