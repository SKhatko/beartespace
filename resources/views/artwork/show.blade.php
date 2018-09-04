@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artwork)
        <div class="app--wrapper">

            <div class="app-artwork">

                <div class="artwork">

                    <div class="artwork--top">

                        <div class="artwork-image" @click="showArtworkImageDialog = !showArtworkImageDialog">
                            <img src="/imagecache/height-200/{{ $artwork->image_url }}" alt="{{ $artwork->image->name }}">
                        </div>

                        <el-dialog  :visible.sync="showArtworkImageDialog">
                            <img src="/imagecache/original/{{ $artwork->image_url }}" alt="{{ $artwork->image->name }}">
                        </el-dialog>

                        <div class="artwork-description">

                            <div class="h3"><a
                                        href="{{ route('artist', $artwork->user->id) }}">{{ $artwork->user->name }}</a>, {{ $artwork->title }}
                            </div>

                            <div class="h4" style="margin-bottom: 20px;">{{ $artwork->user->country['country_name'] }}</div>

                            <el-button>
                                <a href="{{ route('cart.item.add', $artwork->id) }}">Add to cart</a>
                            </el-button>

                            <el-button>
                                <a href="{{ route('cart.item.buy-now', $artwork->id) }}">Buy Now</a>
                            </el-button>

                        </div>
                    </div>

                    <div class="artwork-images">
                        <el-carousel indicator-position="outside">

                            @foreach($artwork->images as $image)
                                <el-carousel-item key="{{ $image->id }}">
                                    <div class="artwork-image">
                                        <img src="/imagecache/height-200/{{ $image->url }}" alt="{{ $image->name }}">
                                    </div>
                                </el-carousel-item>
                            @endforeach

                        </el-carousel>

                    </div>

                </div>


            </div>

        </div>
    @endif

@endsection