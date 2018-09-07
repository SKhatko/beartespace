@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artwork)
        <div class="app--wrapper">

            <div class="app-artwork">

                <div class="artwork">

                    <div class="artwork--top">

                        <div class="artwork-image" @click="showArtworkImageDialog = !showArtworkImageDialog">
                            <img src="/imagecache/height-200/{{ $artwork->image_url }}"
                                 alt="{{ $artwork->image->name }}">
                        </div>

                        <el-dialog :visible.sync="showArtworkImageDialog" center>
                            <img src="/imagecache/original/{{ $artwork->image_url }}" alt="{{ $artwork->image->name }}">
                        </el-dialog>

                        <div class="artwork--right">
                            <el-card class="artwork-description">

                                <div class="artwork-name">{{ $artwork->title }} by <b>{{ $artwork->user->name }}</b>
                                </div>

                                @if($artwork->user->country)
                                    <div class="artwork-country">
                                        Location: {{ $artwork->user->country['country_name'] }}
                                    </div>
                                @endif

                                <div class="artwork-status {{ $artwork->stock_status === 'available' ? 'active' : '' }}">
                                    {{ trans('stock-status.' . $artwork->stock_status) }}
                                </div>

                                <div class="artwork-price">
                                    {{ $artwork->formatted_price }}
                                </div>

                                @if(!$artwork->sold && $artwork->available)
                                    @if(Cart::content()->contains('id', $artwork->id))
                                        <el-tag type="info">Item is added to shopping cart</el-tag>

                                        <el-button type="text" style="display: block;width: 100%;">
                                            <a href="{{ route('cart.item.remove', $artwork->id) }}">Remove</a>
                                        </el-button>
                                    @else
                                        <el-button style="display: block;width: 100%;">
                                            <a href="{{ route('cart.item.add', $artwork->id) }}">Add to cart</a>
                                        </el-button>
                                    @endif

                                    <div style="margin-top: 20px;">
                                        <el-button style="display: block;width: 100%;">
                                            <a href="{{ route('cart.item.buy-now', $artwork->id) }}">Buy Now</a>
                                        </el-button>
                                    </div>
                                @endif

                                <div class="artwork-favorite">
                                    @if(auth()->user() && auth()->user()->favoriteArtworks->contains('id', $artwork->id))
                                        <el-tag type="info">Artwork is added to Favorite</el-tag>

                                        <el-button type="text">
                                            <a href="{{ route('favorite.toggle', $artwork->id) }}">Remove</a>
                                        </el-button>
                                    @else
                                        <el-button style="display: block;width: 100%;">
                                            <a href="{{ route('favorite.toggle', $artwork->id) }}">Add to Favorite</a>
                                        </el-button>
                                    @endif
                                </div>

                            </el-card>

                            <el-card>

                                <div class="artwork-category">
                                    Category: {{ trans('category.' . $artwork->category) }}
                                </div>

                                <div class="artwork-size">
                                    Size: {{ $artwork->width }} x {{ $artwork->height }} x {{ $artwork->depth }}
                                </div>

                                <div class="artwork-medium">
                                    Materials: @foreach($artwork->medium as $medium)
                                        {{ trans_input('medium.' . $medium ) }},
                                    @endforeach
                                </div>

                                @if($artwork->favoritedUsers()->count())
                                    <div class="artwork-favorited">
                                        Favorited by: {{ $artwork->favoritedUsers()->count() }} people
                                    </div>
                                @endif

                                <a href="{{ route('artist', $artwork->user->id) }}" class="artwork-artist">
                                    Artist:
                                    <span class="artwork-artist-avatar">
                                        <img src="/imagecache/mini-avatar/{{ $artwork->user->avatar_url}}"/>
                                    </span>

                                    {{ $artwork->user->name }}
                                </a>
                            </el-card>


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