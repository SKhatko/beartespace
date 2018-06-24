@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection


@section('content')

    <el-aside>

        @include('dashboard.partials.menu', ['index' => 'languages'])

    </el-aside>

    <el-main>

        <div class="admin a">

            <div class="a-content">

                <languages
                        :translated-languages_="{{ $translatedLanguages }}"
                        :languages_="{{ $languages }}">
                </languages>

            </div>

        </div>

    </el-main>

@endsection
