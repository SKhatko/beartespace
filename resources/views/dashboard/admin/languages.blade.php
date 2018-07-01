
@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <languages
            :translated-languages_="{{ $translatedLanguages }}"
            :languages_="{{ $languages }}">
    </languages>

@endsection

