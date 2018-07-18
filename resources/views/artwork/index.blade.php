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

                        <el-card class="artwork">
                            <div class="artwork-top">
                                <a href="{{ route('artwork', $artwork->id) }}" class="artwork-image">
                                    <img src="{{ $artwork->images()->first()->name }}" alt="">
                                </a>

                                <div class="artwork-panel">
                                    <el-button icon="el-icon-star-off" class="artwork-panel-favourite"
                                               circle></el-button>
                                    <el-button icon="el-icon-goods" class="artwork-panel-cart" circle></el-button>

                                    {{--<a href="#" class="artwork-favorite"><span class="e"></span></a>--}}
                                    {{--<a href="{{ route('toggle-to-cart', $artwork->id) }}" class="artwork-cart"><span class="el-icon-goods"></span></a>--}}
                                </div>
                            </div>

                            <a href="{{ route('artwork', $artwork->id) }}" class="artwork-title">
                                {{ $artwork->title }}
                            </a>

                            <div class="artwork-bottom">
                                <div class="artwork-info">
                                    <div class="h4">{{ $artwork->user['name'] }}</div>
                                    <div class="h5">{{ $artwork->user->country['country_name'] }}</div>
                                </div>

                                <div class="artwork-price">
                                    {{ $artwork->price }} EUR
                                </div>
                            </div>


                        </el-card>

                    @endforeach

                </div>
            </main>
        </div>


    </div>

@endsection