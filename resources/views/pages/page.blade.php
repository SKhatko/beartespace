@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">
        @if($page)

            <div class="app-page">
                {!! $page->content !!}
            </div>

        @endif

    </div>

@endsection
