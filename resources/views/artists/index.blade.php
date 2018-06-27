@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artists</h2>

        @foreach($artists as $artist)

            @dump($artist)

        @endforeach
    </div>

@endsection