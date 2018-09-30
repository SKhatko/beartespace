@extends('dashboard.index')

@section('admin-content')

    <div class="app--wrapper">
        <div class="app-translations">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Translations</el-breadcrumb-item>
            </el-breadcrumb>

            <translations
                    languages_="{{ $languages }}"
                    translations_="{{ $translations }}">
            </translations>

        </div>
    </div>



@endsection
