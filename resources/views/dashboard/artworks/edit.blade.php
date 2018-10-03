@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')


    <div class="app--wrapper">
        <div class="app-artwork-form">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin-bottom: 30px;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard/artwork">Artworks</a></el-breadcrumb-item>
                <el-breadcrumb-item>Edit Artwork</el-breadcrumb-item>
            </el-breadcrumb>

            <artwork-form artwork_="{{ $artwork }}" currencies_="{{ json_encode(currency()->all()) }}"></artwork-form>

        </div>
    </div>

@endsection
