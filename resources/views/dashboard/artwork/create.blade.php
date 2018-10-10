@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <el-breadcrumb separator-class="el-icon-arrow-right" style="margin-bottom: 30px;">
        <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard/artwork">Artworks</a></el-breadcrumb-item>
        <el-breadcrumb-item>Add new Artwork</el-breadcrumb-item>
    </el-breadcrumb>

    <dashboard-artwork currencies_="{{ json_encode(currency()->all()) }}"></dashboard-artwork>

@endsection
