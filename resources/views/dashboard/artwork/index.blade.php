@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app-dashboard-artworks">

        @include('dashboard.partials.profile')

        <dashboard-artworks artworks_="{{ $artworks }}"></dashboard-artworks>

    </div>

@endsection
