@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-favorites">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Favorites</el-breadcrumb-item>
            </el-breadcrumb>


            <el-card>
                <el-tabs value="artworks">
                    <el-tab-pane label="Artworks" name="artworks">
                        @include('partials.artworks', $artworks)
                    </el-tab-pane>
                    <el-tab-pane label="Artists" name="artists">Artists</el-tab-pane>
                    <el-tab-pane label="Galleries" name="galleries">Galleries</el-tab-pane>
                </el-tabs>
            </el-card>



        </div>

    </div>

@endsection



