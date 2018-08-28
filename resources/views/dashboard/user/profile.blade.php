@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <el-breadcrumb separator-class="el-icon-arrow-right" style="margin-bottom: 30px;">
        <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
        <el-breadcrumb-item>Profile</el-breadcrumb-item>
    </el-breadcrumb>

    @include('partials.back')

    <profile user_="{{ $user }}"></profile>

@endsection

@section('script')
    {{--<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.api_key') }}&libraries=places"></script>--}}
@stop
