@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">

            <artists-menu :artists_="{{ $artists }}"></artists-menu>

            <div class="artists">

                @foreach($artists as $artist)

                    <el-card style="margin-bottom: 30px">

                        <div class="artist">

                            <a href="{{ route('artist', $artist->id) }}" class="artist-avatar">
                                <img src="{{ $artist->avatar->url }}" alt="{{ $artist->avatar->name }}">
                            </a>

                            <div class="artist-artworks">

                                @foreach($artist->artworks->random(3) as $artwork)

                                    <a href="{{ route('artwork', $artwork->id) }}" class="artist-artwork">
                                        <img src="{{ $artwork->images->first()->url }}"
                                             alt="{{ $artwork->images->first()->name }}">
                                    </a>

                                @endforeach

                            </div>

                        </div>


                        <div class="artist-footer">
                            <div class="artist-info">

                                <a href="{{ route('artist', $artist->id) }}" class="h4">
                                    {{ $artist->name }}
                                </a>

                                <div class="h5">{{ $artist->country['country_name'] }}</div>
                            </div>
                            <div class="artist-follow">
                                <el-button type="primary" plain size="small">Follow</el-button>
                            </div>
                        </div>


                    </el-card>

                @endforeach

            </div>

        </div>


    </div>

@endsection