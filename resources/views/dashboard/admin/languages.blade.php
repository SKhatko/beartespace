@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection


@section('content')

    <div class="admin a">

        @include('dashboard.partials.menu', ['index' => 'languages'])

        <div class="a-content">

            <languages
                    :translated-languages_="{{ $translatedLanguages }}"
                    :languages_="{{ $languages }}">
            </languages>

        </div>

    </div>

@endsection
