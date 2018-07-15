@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper" style="text-align: center;">
        artworks, autors, sliders (Main page here)

    </div>

@endsection