
@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

   Messages here

@endsection