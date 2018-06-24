@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <users
            :users_="{{ $users }}">
    </users>

@endsection
