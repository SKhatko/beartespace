@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Artists</el-breadcrumb-item>
            </el-breadcrumb>

            <artists-menu></artists-menu>

            <div class="artists">

                @foreach($artists as $artist)

                    <el-card style="margin-bottom: 50px">

                        <div class="artist">
                            <div class="artist-header">
                                <a href="{{ route('artist', $artist->id) }}" class="artist-avatar">
                                    <img src="/imagecache/avatar{{ $artist->avatar_url }}"
                                         alt="{{ $artist->avatar ? $artist->avatar->name : $artist->name }}">
                                </a>

                                <div class="artist-info">

                                    <a href="{{ route('artist', $artist->id) }}" class="h2"
                                       style="margin-bottom: 20px;">
                                        {{ $artist->name }}
                                    </a>

                                    <a href="{{ route('artist', $artist->id) }}" class="h4"
                                       style="margin-bottom: 10px;">
                                        {{--                                    @foreach(json_decode($artist->profession) as $profession)--}}
                                        @foreach($artist->profession as $profession)
                                            @if($loop->index > 0)
                                                |
                                            @endif
                                            @lang('profession.' . $profession)
                                        @endforeach
                                    </a>

                                    <a href="{{ route('artist', $artist->id) }}" class="h3">
                                        {{ $artist->country['country_name'] ?? '' }}
                                    </a>

                                </div>
                            </div>

                            <div class="artist-artworks">

                                @foreach($artist->artworks->take(3) as $artwork)

                                    @if($artwork->image)
                                        <a href="{{ route('artwork', $artwork->id) }}" class="artist-artwork">
                                            <img src="/imagecache/height-200{{ $artwork->image_url }}"
                                                 alt="{{ $artwork->image->name }}">
                                        </a>
                                    @endif

                                @endforeach

                            </div>

                        </div>


                        <div class="artist-footer">
                            <el-button type="success" plain size="small"><a href="{{ route('artist', $artist->id) }}">
                                    See more
                                </a></el-button>
                            {{--<el-button type="primary" plain size="small">Follow</el-button>--}}
                        </div>


                    </el-card>

                @endforeach

                <div class="artists-bottom" style="text-align: center;margin-bottom: 50px;">

                    <el-button><a href="/selection/artist">See artists of the week</a></el-button>

                    @if($artists->hasMorePages())
                        <el-button><a href="{{  $artists->nextPageUrl() }}">See more Artists</a></el-button>
                    @endif
                    <el-button><a href="{{ route('artworks') }}">Go to Artworks</a></el-button>
                    <el-button><a href="{{ route('auctions') }}">Go to Auctions</a></el-button>
                </div>

                {{ $artists->links() }}

            </div>

        </div>


    </div>

@endsection