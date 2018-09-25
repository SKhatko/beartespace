@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <el-breadcrumb separator-class="el-icon-arrow-right" style="margin-bottom: 30px;">
        <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
        <el-breadcrumb-item>Favorite Artworks</el-breadcrumb-item>
    </el-breadcrumb>

    <div class="app--wrapper">

        <main>

            @include('partials.artworks', $artworks)

        </main>

    </div>

@endsection



