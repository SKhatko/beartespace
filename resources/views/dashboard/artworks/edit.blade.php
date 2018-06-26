@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('admin.flash_msg')

    @include('partials.errors')

    <artwork :artwork_="{{ $artwork }}"></artwork>

@endsection
