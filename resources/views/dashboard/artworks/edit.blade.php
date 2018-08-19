@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

    @include('partials.back')

    <artwork-form artwork_="{{ $artwork }}" currencies_="{{ json_encode(currency()->all()) }}"></artwork-form>

@endsection
