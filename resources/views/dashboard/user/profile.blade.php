@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <profile-form user_="{{ $user }}"></profile-form>

@endsection

@section('script')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&libraries=places"></script>--}}
@stop
