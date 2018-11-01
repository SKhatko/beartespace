@extends('master')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('header')
    @include('layouts.header.sell')
@endsection

@section('footer')
    @include('layouts.footer.bottom')
@endsection