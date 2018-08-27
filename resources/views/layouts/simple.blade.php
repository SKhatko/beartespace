@extends('master')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('header')
    @include('layouts.header.middle')
@endsection

@section('footer')
    @include('layouts.footer.bottom')
@endsection