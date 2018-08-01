@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artworks">

            <artworks-menu></artworks-menu>

            <main>

                @include('partials.artworks', $artworks)

            </main>
        </div>


    </div>

@endsection