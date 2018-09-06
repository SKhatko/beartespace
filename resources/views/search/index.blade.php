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
                @foreach($artworks as $artwork)
                    <div class="artwork">
                        <a href="{{ route('artwork', $artwork->id) }}">{{ $artwork->title }}</a>
                    </div>
                @endforeach
            @elseif(count($artists))
                @foreach($artists as $artist)
                    <div class="artist">
                        <a href="{{ route('artist', $artist->id) }}">{{ $artist->name }}</a>
                    </div>
                @endforeach
            @else
                <div class="h3" style="text-align: center;">Nothing found</div>
            @endif

        </div>
    </div>

@endsection