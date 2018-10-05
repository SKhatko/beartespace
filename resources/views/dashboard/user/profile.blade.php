@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app--wrapper">
        <div class="app-profile">

            <profile user_="{{ $user }}"></profile>

        </div>
    </div>

@endsection

@section('script')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&libraries=places"></script>--}}
@stop
