@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">

            <artists-menu :artists_="{{ $artists }}"></artists-menu>

            <main>

                <h2 class="h2">Artists</h2>

                <div class="artists">

                    @if(count($artists))
                        @foreach($artists as $artist)

                            <el-card class="artist">

                                <a href="{{ route('artist', $artist->id) }}" class="artist-photo">
                                    <img src="{{ $artist->photo->name }}" alt="">
                                </a>

                                <a href="{{ route('artist', $artist->id) }}" class="artist-name"
                                   style="display: block;">
                                    {{ $artist->name }}
                                </a>

                                <div class="artist-panel">
                                    <a href="#" class="artist-favorite"><span class="el-icon-star-off"></span></a>
                                </div>

                                <div class="h4">{{ $artist->user['name'] }}</div>

                                <div class="h5">{{ $artist->country['country_name'] }}</div>


                            </el-card>

                        @endforeach
                    @endif

                </div>
            </main>
        </div>


    </div>

@endsection