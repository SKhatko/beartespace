
@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <div class="app--wrapper">
        <div class="app-settings">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Settings</el-breadcrumb-item>
            </el-breadcrumb>

            <settings artists_="{{ $artists }}" settings_="{{ $settings }}" artworks_="{{ $artworks }}"></settings>

        </div>
    </div>


@endsection

