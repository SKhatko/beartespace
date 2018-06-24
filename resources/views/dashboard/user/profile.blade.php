@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <profile
            :trans_="{{ json_encode(trans('portal')) }}"
            :user_="{{ $user }}"
            :countries_="{{ $countries }}">
    </profile>

@endsection
