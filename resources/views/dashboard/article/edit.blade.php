@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
        <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
        <el-breadcrumb-item><a href="/dashboard/article">Articles</a></el-breadcrumb-item>
        <el-breadcrumb-item>Edit article</el-breadcrumb-item>
    </el-breadcrumb>

    <article-form article_="{{ $article }}"></article-form>

@endsection

