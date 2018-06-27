@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <pages
            :languages_="{{ $languages }}"
            :pages_="{{ $pages }}">
    </pages>

@endsection
