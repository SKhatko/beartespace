@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($auction)
        <div class="app--wrapper">

            <div class="app-artwork">

                <div class="artwork">

                    <div class="artwork--top">

                        <div class="artwork-image">
                            <img src="/imagecache/height-200/{{ $auction->image_url }}" alt="{{ $auction->image->name }}">
                        </div>

                        <div class="artwork-description">

                            <div class="h3"><a
                                        href="{{ route('artist', $auction->user->id) }}">{{ $auction->user->name }}</a>, {{ $auction->title }}
                            </div>

                            <div class="h4">{{ $auction->user->country['country_name'] }}</div>

                            <el-button>
                                <a href="{{ route('cart.item.add', $auction->id) }}">Add to cart</a>
                            </el-button>

                        </div>
                    </div>

                    <div class="artwork-images">
                        <el-carousel indicator-position="outside">

                            @foreach($auction->images as $image)
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