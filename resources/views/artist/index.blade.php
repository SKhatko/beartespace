@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    {{--<div class="app--wrapper">--}}

    <div class="app-artists">

        <artists-menu artists_="{{ $artists }}"></artists-menu>

        <div class="artists">

            @foreach($artists as $artist)

                <el-card style="margin-bottom: 50px">

                    <div class="artist">
                        <div class="artist-header">
                            @if($artist->avatar)
                                <a href="{{ route('artist', $artist->id) }}" class="artist-avatar">
                                    <img src="{{ $artist->avatar->url }}" alt="{{ $artist->avatar->name }}">
                                </a>
                            @endif

                            <div class="artist-info">

                                <a href="{{ route('artist', $artist->id) }}" class="h2">
                                    {{ $artist->name }} {{ $artist->profession }} {{ $artist->country['country_name'] ?? '' }}
                                </a>

                            </div>
                        </div>

                        <div class="artist-artworks">

                            @foreach($artist->artworks->take(3) as $artwork)

                                @if($artwork->images->first())
                                    <a href="{{ route('artwork', $artwork->id) }}" class="artist-artwork">
                                        <img src="{{ $artwork->images->first()->url }}"
                                             alt="{{ $artwork->images->first()->name }}">
                                    </a>
                                @endif

                            @endforeach

                        </div>

                    </div>


                    <div class="artist-footer">
                        <el-button type="primary" plain size="small">Follow</el-button>
                    </div>


                </el-card>

            @endforeach

        </div>

    </div>


    {{--</div>--}}

@endsection