@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <div class="app--wrapper">
        <div class="app-artwork-form">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin-bottom: 30px;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard/artwork">Artworks</a></el-breadcrumb-item>
                <el-breadcrumb-item>Add new Artwork</el-breadcrumb-item>
            </el-breadcrumb>

            <artwork-form user_="{{ auth()->user() }}" currencies_="{{ json_encode(currency()->all()) }}"></artwork-form>

        </div>
  </div>

@endsection
