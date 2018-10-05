@extends('dashboard.index')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('dashboard-content')

    <div class="app--wrapper">
        <div class="app-profile">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item><a href="/dashboard">Dashboard</a></el-breadcrumb-item>
                <el-breadcrumb-item>Artworks</el-breadcrumb-item>
            </el-breadcrumb>

            @foreach($artworks as $artwork)
                <div class="artwork">

                    <a href="{{ route('artwork', $artwork->id) }}" class="h2" target="_blank">{{ $artwork->name }}</a>

                    <div class="artwork-image">
                        @if($artwork->image)
                            <img src="{{ $artwork->image_url }}" alt="" style="max-width: 200px; max-height: 200px">
                        @endif
                    </div>

                    <div>
                        <el-button type="text">
                            <a href="{{ route('dashboard.artwork.edit', $artwork->id) }}">Edit</a>
                        </el-button>
                    </div>

                </div>

                <hr>


            @endforeach

        </div>

    </div>


@endsection
