@extends('master')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('header')

    @include('layouts.header.middle')
    @include('layouts.header.bottom')

@endsection



@section('footer')
    @include('layouts.footer.middle')
    @include('layouts.footer.bottom')
@endsection