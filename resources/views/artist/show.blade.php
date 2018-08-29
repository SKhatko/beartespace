@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artist)

        <div class="app-artist">

            <div class="app--wrapper">
                <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                    <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                    <el-breadcrumb-item><a href="/artist">Artists</a></el-breadcrumb-item>
                    <el-breadcrumb-item>{{ $artist->name }}</el-breadcrumb-item>
                </el-breadcrumb>
            </div>

            <div class="artist">

                @if($artist->profile_premium_add || $artist->profile_background_image_add)
                    <div class="artist-image"
                         style="background-image: url({{ '/imagecache/original' .  $artist->image_url }});">

                        <div class="artist-image--fade">

                            <div class="artist-info">
                                <div class="h2" style="margin-bottom: 20px;">
                                    @foreach($artist->profession as $profession)
                                        @if($loop->index > 0)
                                            |
                                        @endif
                                        @lang('profession.' . $profession)
                                    @endforeach
                                </div>
                                <div class="h4" style="margin-bottom: 30px;">
                                    {{ $artist->country['country_name'] ?? '' }}
                                </div>


                                <div class="h1" style="margin-bottom: 50px;font-size: 70px;">{{ $artist->name }} </div>

                                <div class="artist-avatar">
                                    <img src="/imagecache/avatar{{ $artist->avatar_url }}"
                                         alt="{{ $artist->avatar->name }}">
                                </div>
                            </div>


                        </div>

                    </div>

                @else
                    <div class="artist-info">
                        <div class="h2" style="margin-bottom: 20px;">
                            @foreach($artist->profession as $profession)
                                @if($loop->index > 0)
                                    |
                                @endif
                                @lang('profession.' . $profession)
                            @endforeach
                        </div>
                        <div class="h4" style="margin-bottom: 30px;">
                            {{ $artist->country['country_name'] ?? '' }}
                        </div>


                        <div class="h1" style="margin-bottom: 50px;font-size: 70px;">{{ $artist->name }} </div>

                        <div class="artist-avatar">
                            <img src="/imagecache/avatar{{ $artist->avatar_url }}" alt="{{ $artist->avatar->name }}">
                        </div>
                    </div>
                @endif
                <div class="app--wrapper">

                    <div class="artist-info">

                        <div class="artist-gender">{{ $artist->gender }}</div>
                        <div class="artist-education">{{ $artist->education }}</div>
                        <div class="artist-education-title">{{ $artist->education_title }}</div>
                        <div class="artist-inspiration">{!! $artist->inspiration !!}</div>
                        <div class="artist-exhibition">{!! $artist->exhibition !!}</div>

                    </div>

                </div>

                <div class="artist-artworks">

                    <div class="app--wrapper">


                        <h2>Other artworks</h2>

                        @include('partials.artworks', ['artworks' => $artist->artworks])

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection