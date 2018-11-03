@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app--wrapper">

        <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
            <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
            <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
            <el-breadcrumb-item>Users</el-breadcrumb-item>
        </el-breadcrumb>

        <users-form users_="{{ $users }}"></users-form>

    </div>

@endsection
