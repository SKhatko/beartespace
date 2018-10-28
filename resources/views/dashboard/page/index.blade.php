@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')


    <div class="app--wrapper">
        <div class="app-pages">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Pages</el-breadcrumb-item>
            </el-breadcrumb>

            <a href="{{ route('admin.pages.create') }}" class="el-button el-button--success"
               style="margin-bottom: 20px;">Create page</a>

            @foreach($pages as $page)

                <div style="margin: 10px 0">{{ $page->name }}
                    <a href="{{ route('admin.pages.edit', $page->id) }}"
                       class="el-button el-button--default el-button--small"><i class="el-icon-edit"></i></a>
                </div>

            @endforeach


        </div>
    </div>


@endsection
