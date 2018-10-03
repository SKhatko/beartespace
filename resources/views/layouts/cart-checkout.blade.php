@extends('master')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('header')
    @include('layouts.header.cart-checkout')
@endsection

@section('footer')
    @include('layouts.footer.bottom')
@endsection