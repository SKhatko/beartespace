
@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('admin-content')

    <div class="app--wrapper">
        <div class="app-languages">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Languages</el-breadcrumb-item>
            </el-breadcrumb>

            <languages
                    translated-languages_="{{ $translatedLanguages }}"
                    languages_="{{ $languages }}">
            </languages>

        </div>
    </div>

@endsection

