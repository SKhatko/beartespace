@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        @if($page)

            {!! $page->content !!}

        @endif

    </div>

@endsection
