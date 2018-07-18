@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">

            <artists-menu :artists_="{{ $artists }}"></artists-menu>

            <main>

                <h2 class="h2">Artists</h2>

                <div class="artists">

                    @foreach($artists as $artist)

                        <el-card class="artist">

                            <a href="{{ route('artist', $artist->id) }}" class="artist-photo">
                                <img src="{{ $artist->photo->name }}" alt="">
                            </a>

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
            </main>
        </div>


    </div>

@endsection