@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app-dashboard-artworks">

        @include('dashboard.partials.profile')

        <div>
            <dashboard-artworks-block artworks_="{{ $artworks }}"></dashboard-artworks-block>

        </div>

    </div>

@endsection
