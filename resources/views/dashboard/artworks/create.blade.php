@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    @include('partials.errors')

    <el-breadcrumb separator-class="el-icon-arrow-right" style="margin-bottom: 30px;">
        <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard/artwork">Artworks</a></el-breadcrumb-item>
        <el-breadcrumb-item>Upload</el-breadcrumb-item>
    </el-breadcrumb>

    @include('partials.back')

    <artwork-form user_="{{ auth()->user() }}" currencies_="{{ json_encode(currency()->all()) }}"></artwork-form>

@endsection
