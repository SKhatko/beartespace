@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artists">
            <aside>

                <el-tree
                        :data="artworkFilters"
                        :props="defaultProps"
                        show-checkbox>
                </el-tree>

            </aside>

            <main>

                <h2 class="h2">Artists</h2>

                <div class="artists">

                    @foreach($artists as $artist)

                        <div class="artist">

                            <a href="{{ route('artist', $artist->id) }}" class="artist-photo">
                                <img src="{{ $artist->photo->name }}" alt="">
                            </a>

                            <a href="{{ route('artist', $artist->id) }}" class="artist-name">
                                {{ $artist->name }}
                            </a>

                            <div class="artist-panel">
                                <a href="#" class="artist-favorite"><span class="el-icon-star-off"></span></a>
                                <a href="{{ route('toggle-to-cart', $artist->id) }}" class="artist-cart"><span class="el-icon-goods"></span></a>
                            </div>

                            <div class="h4">{{ $artist->user['name'] }}</div>

                            <el-row :gutter="20">

                                <el-col :span="16">
                                    <div class="h5">{{ $artist->country['country_name'] }}</div>
                                </el-col>

                                <el-col :span="8">
                                    <div class="artist-price">
                                        {{ $artist->price }} EUR
                                    </div>
                                </el-col>
                            </el-row>

                        </div>

                    @endforeach

                </div>
            </main>
        </div>


    </div>

@endsection