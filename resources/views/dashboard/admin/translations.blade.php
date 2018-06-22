@extends('layouts.app')

@section('content')

    <div class="admin a">

        @include('dashboard.partials.menu', ['index' => 'translations'])

        <div class="a-content">
            <translations
                    :languages_="{{ $languages }}"
                    :translations_="{{ $translations }}">
            </translations>
        </div>

    </div>

@endsection
