@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artworks">

            <artworks-menu></artworks-menu>


            <main>

                <h2 class="h2">Artworks</h2>

                <div class="artworks">

                    @foreach($artworks as $artwork)

                        <div class="artwork">
                            <a href="{{ route('artwork', $artwork->id) }}" class="artwork-image">
                                <img src="{{ $artwork->images()->first()->name }}" alt="">
                            </a>

                            <a href="{{ route('artwork', $artwork->id) }}" class="artwork-title">
                                {{ $artwork->title }}
                            </a>


                            <div class="artwork-panel">
                                <a href="#" class="artwork-favorite"><span class="el-icon-star-off"></span></a>
                                <a href="{{ route('toggle-to-cart', $artwork->id) }}" class="artwork-cart"><span class="el-icon-goods"></span></a>
                            </div>

                            <div class="h4">{{ $artwork->user['name'] }}</div>


                            <el-row :gutter="20">

                                <el-col :span="16">
                                    <div class="h5">{{ $artwork->user->country['country_name'] }}</div>
                                </el-col>

                                <el-col :span="8">
                                    <div class="artwork-price">
                                        {{ $artwork->price }} EUR
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