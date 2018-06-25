@extends('dashboard.index')

@section('admin-content')

    <translations
            :languages_="{{ $languages }}"
            :translations_="{{ $translations }}">
    </translations>

@endsection
