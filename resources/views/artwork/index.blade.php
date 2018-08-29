@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artworks">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Artworks</el-breadcrumb-item>
            </el-breadcrumb>

            <artworks-menu></artworks-menu>

            <main>

                @include('partials.artworks', $artworks)

                <div class="artworks-bottom" style="text-align: center;margin-bottom: 50px;">

                    <el-button><a href="/selection/artwork">See artworks of the week</a></el-button>

                    @if($artworks->hasMorePages())
                        <el-button><a href="{{  $artworks->nextPageUrl() }}">See more Artworks</a></el-button>
                    @endif
                    <el-button><a href="{{ route('artists') }}">Browse Artists</a></el-button>
                    <el-button><a href="{{ route('auctions') }}">Go to Auctions</a></el-button>
                </div>

                {{ $artworks->links() }}

            </main>
        </div>


    </div>

@endsection