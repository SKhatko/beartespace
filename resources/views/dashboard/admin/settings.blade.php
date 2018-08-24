
@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <settings artists_="{{ $artists }}" settings_="{{ $settings }}" artworks_="{{ $artworks }}"></settings>

@endsection

