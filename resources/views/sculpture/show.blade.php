@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Sculpture</h2>

        <a href="{{ route('artist', $artwork->user->id) }}">{{ $artwork->user->name }}</a>


        <div class="artwork" style="display: flex">

            <div>
                Title {{ $artwork->title }} <br>
                Autor {{ $artwork->user['name'] }} <br>
                Country {{ $artwork->user->country['country_name'] }} <br>

            </div>


            <img src="{{ $artwork->image }}" alt="" style="max-height: 400px">


        </div>

        <hr>

    </div>

@endsection