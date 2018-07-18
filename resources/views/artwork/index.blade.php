@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artworks">

            <artworks-menu></artworks-menu>

            <main>

                <h2 class="h2">Artworks</h2>

                @include('partials.artworks', $artworks)

            </main>
        </div>


    </div>

@endsection