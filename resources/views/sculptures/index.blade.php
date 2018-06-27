@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <h2>Sculptures</h2>

        @foreach($sculptures as $sculpture)

            @dump($sculpture)

        @endforeach
    </div>

@endsection