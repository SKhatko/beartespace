@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-search">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Search</el-breadcrumb-item>
            </el-breadcrumb>

            @if(count($artworks))
                <artworks-block artworks_="{{ $artworks }}"></artworks-block>
            @elseif(count($artists))
                @include('artist.artists-block', ['artists' => $artists])
            @else
                <div class="h3" style="text-align: center;">Nothing found</div>
            @endif

        </div>
    </div>

@endsection