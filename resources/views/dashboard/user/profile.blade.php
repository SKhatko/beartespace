@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.back')

    <profile
            :user_="{{ $user }}"
            :countries_="{{ $countries }}">
    </profile>

@endsection

@section('script')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&libraries=places"></script>--}}
@stop
