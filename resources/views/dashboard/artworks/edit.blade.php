@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

{{--    @dd(currency()->all())--}}

    <artwork artwork_="{{ $artwork }}" currencies_="{{ json_encode(currency()->all()) }}"></artwork>

@endsection
