@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

    <artwork :artwork_="{{ $artwork }}" :images_="{{ $artwork->images }}"></artwork>

@endsection
