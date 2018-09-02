@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artwork)
        <div class="app--wrapper">

            <div class="app-artwork">

                <div class="artwork">

                    <div class="artwork-images">
                        <el-carousel indicator-position="outside">
                            <el-carousel-item key="{{ $artwork->image->id }}">
                                <div class="artwork-image">
                                    <img src="/imagecache/height-200/{{ $artwork->image_url }}" alt="{{ $artwork->image->name }}">
                                </div>
                            </el-carousel-item>

                            @foreach($artwork->images as $image)
                                <el-carousel-item key="{{ $image->id }}">
                                    <div class="artwork-image">
                                        <img src="/imagecache/height-200/{{ $image->url }}" alt="{{ $image->name }}">
                                    </div>
                                </el-carousel-item>
                            @endforeach

                        </el-carousel>

                    </div>

                    <div class="artwork-description">

                        <div class="h3"><a
                                    href="{{ route('artist', $artwork->user->id) }}">{{ $artwork->user->name }}</a>, {{ $artwork->title }}
                        </div>

                        <div class="h4">{{ $artwork->user->country['country_name'] }}</div>

                        <el-button>
                            <a href="{{ route('add-to-cart', $artwork->id) }}">Add to cart</a>
                        </el-button>

                    </div>
                </div>


            </div>

        </div>
    @endif

@endsection