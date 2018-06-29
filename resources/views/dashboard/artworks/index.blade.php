@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('admin.flash_msg')

    @include('partials.errors')

    @foreach($artworks as $artwork)

        <h2>
            <a href="{{ route('dashboard.artwork.edit', $artwork->id) }}">{{ $artwork->id . '. ' . $artwork->title }}</a>
        </h2>

    @endforeach

@endsection
