@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

    @include('partials.back')

    <artwork-form user_="{{ auth()->user() }}" currencies_="{{ json_encode(currency()->all()) }}"></artwork-form>

@endsection
