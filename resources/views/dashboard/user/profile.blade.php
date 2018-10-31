@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')


        <profile-form user_="{{ $user }}"></profile-form>

        {{--        @include('dashboard.partials.profile')--}}

@endsection
