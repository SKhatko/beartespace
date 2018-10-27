@extends('layouts.sell')

@section('sell-status')
    <el-steps :active="2" align-center finish-status="success" class="app-header-sell">
        <el-step description="Name"></el-step>
        <el-step description="Profile"></el-step>
        <el-step description="Artworks"></el-step>
        <el-step description="Payments"></el-step>
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

                            <div class="sell-artwork-image">
                                <img src="/imagecache/fit-290{{ $artwork->image_url }}" alt="">

                                <a href="{{ route('sell.artwork.edit', $artwork->id) }}"
                                   class="el-button el-button--default el-button--mini sell-artwork-edit">Edit</a>
                            </div>

                            <div class="artwork-info">
                                <div class="sell-artwork-name">{{ $artwork->name }}</div>
                            </div>

                        </el-col>
                    @endforeach

                </el-row>

                <div class="sell-artwork-bottom">
                    <div class="app--wrapper">

                        <a href="/sell/profile" class="el-button el-button--default">Edit profile</a>
                        @if($artworks->count() > 0)
                            <a href="/sell/payments" class="el-button el-button--primary">Continue</a>
                        @endif

                    </div>
                </div>
            </el-card>

        </div>
    </div>

@stop
