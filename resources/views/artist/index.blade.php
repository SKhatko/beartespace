@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">

            <main>
                <artists-menu></artists-menu>

                <div class="artists">

                    @foreach($artists as $artist)

                        <el-card style="margin-bottom: 20px;">
                            <div class="artist">

                                <div class="artist-info">

                                    <a href="{{ route('artist', $artist->id) }}" class="artist-avatar">
                                        <img src="/imagecache/fit-150{{ $artist->avatar_url }}"
                                             alt="{{ $artist->avatar ? $artist->avatar->name : $artist->name }}">
                                    </a>

                                    <a href="{{ route('artist', $artist->id) }}" class="h2"
                                       style="margin-bottom: 20px;">
                                        {{ $artist->name }}
                                    </a>

                                    <a href="{{ route('artist', $artist->id) }}" class="h3">
                                        {{ $artist->country['country_name'] }}
                                    </a>

                                    @if(auth()->user())
                                        <follow-button
                                                follow_="{{ auth()->user()->followedUsers->contains($artist->id) }}"
                                                user-id_="{{ $artist->id }}">
                                            {{ $artist->name }}
                                        </follow-button>
                                    @endif

                                </div>

                                <div class="artist-artworks">

                                    @foreach($artist->artworks->take(8) as $artwork)

                                        <a href="{{ route('artwork', $artwork->id) }}" target="_blank" class="artist-artwork">
                                            <img src="/imagecache/fit-150{{ $artwork->image_url }}"
                                                 alt="{{ $artwork->image->name }}">
                                        </a>

                                    @endforeach

                                </div>

                            </div>


                        </el-card>

                    @endforeach


                </div>

            </main>


            <div class="artists-bottom">

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

@endsection