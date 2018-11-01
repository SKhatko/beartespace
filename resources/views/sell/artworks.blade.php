@extends('layouts.sell')

@section('sell-status')
    <el-steps :active="2" align-center finish-status="success" class="app-header-sell">
        <el-step description="Name"></el-step>
        <el-step description="Profile"></el-step>
        <el-step description="Artworks"></el-step>
    </el-steps>
@endsection

@section('content')

    <div class="app--wrapper">
        <div class="app-sell-artworks">

            <el-card>
                <div slot="header">Upload at least one of your artworks</div>

                <el-row :gutter="20">

                    <el-col :xs="12" :sm="8" :md="6" class="sell-artwork-new">

                        <a href="{{ route('sell.artwork.create') }}"
                           class="el-button el-button--default sell-artwork-new-link">
                            <i class="el-icon-plus"></i>
                            <span>Upload</span>
                        </a>

                    </el-col>

                    @foreach($artworks as $artwork)
                        <el-col :xs="12" :sm="8" :md="6" class="sell-artwork">

                            <a href="{{ route('sell.artwork.edit', $artwork->id) }}" class="sell-artwork-image">
                                <img src="/imagecache/fit-290{{ $artwork->image_url }}" alt="">
                            </a>

                            <a href="{{ route('sell.artwork.edit', $artwork->id) }}" class="artwork-info">
                                <div class="sell-artwork-name">{{ $artwork->name }}</div>
                            </a>

                        </el-col>
                    @endforeach

                </el-row>

                <div class="app--fixed-bottom">
                    <div class="app--wrapper">

                        <a href="/sell/profile" class="el-button el-button--default">Edit profile</a>

                        <a href="/sell/apply" class="el-button el-button--primary">Apply</a>


                    </div>
                </div>
            </el-card>

        </div>
    </div>

@stop
