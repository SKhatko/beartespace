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
                                     alt="{{ $artist->avatar ? $artist->avatar->name : $artist->name }}">
                            </div>

                            @if(auth()->user())
                                <follow-button
                                        follow_="{{ auth()->user()->followedUsers->contains($artist->id) }}"
                                        user-id_="{{ $artist->id }}">
                                </follow-button>
                            @endif

                            @if($artist->created_at)
                                <div class="h3">
                                    Joined BearteSpace {{ $artist->created_at->diffForHumans() }}
                                </div>
                            @endif

                            @if($artist->followedBy)
                                Followed by {{ $artist->followedBy->count() }} people
                            @endif

                            @if($artist->inspiration)
                                Inspiration: {{ $artist->inspiration }}
                            @endif

                            @if($artist->exhibition)
                                Exhibition: {{ $artist->exhibition }}
                            @endif

                            <div class="artist-gender">{{ $artist->gender }}</div>


                            <div class="artist-education">Education: {{ $artist->education }}</div>
                            <div class="artist-education-title">Education title: {{ $artist->education_title }}</div>

                        </div>


                    </div>

                </div>

                <div class="app--wrapper">

                    <div class="artist-info">



                    </div>

                </div>

                <div class="artist-artworks">

                    <div class="app--wrapper">

                        @if($artist->favouriteArtworks->count())
                            <div class="artist-artworks-favorite">

                                <h2 class="h2">Artist's favorite artworks</h2>
                                @include('partials.artworks', ['artworks' => $artist->favouriteArtworks])

                            </div>
                        @endif


                        <h2>Other artworks</h2>

                        @include('partials.artworks', ['artworks' => $artist->artworks])

                    </div>

                </div>

            </div>

        </div>

    @endif

@endsection