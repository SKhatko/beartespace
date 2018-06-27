@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Artists</h2>

        @foreach($artists as $artist)

            Artist {{ $artist->id }}

        @endforeach
    </div>

@endsection