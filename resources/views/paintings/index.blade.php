@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        <h2>Paintings</h2>

        @foreach($paintings as $painting)

            @dump($painting)

        @endforeach
    </div>

@endsection