@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Paintings</h2>

        @foreach($paintings as $painting)

            <h3><a href="{{ route('artwork', $painting->id) }}">{{ $painting->title }}</a></h3>

            <div>
                Autor {{ $painting->user['name'] }} <br>
                Country {{ $painting->user->country['country_name'] }} <br>

                <img src="{{ $painting->images()->first()->name }}" alt="" style="max-width: 900px">
            </div>
            <hr>

        @endforeach
    </div>

@endsection