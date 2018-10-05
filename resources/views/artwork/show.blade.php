@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    @if($artwork)
        <div class="app--wrapper">

            <div class="app-artwork">

                <div class="artist">
                    <div class="artist-info">
                        <img src="/imagecache/original{{ $artwork->user->avatar_url }}" class="artist-avatar" alt="">
                        <a href="{{ route('artist', $artwork->user->id) }}"
                           class="artist-name">{{ $artwork->user->name }}</a>

                        @if($artwork->user->followedBy->count() > 0)
                            <div class="artist-followed">
                                Followed by {{ $artwork->user->followedBy->count() }} people
                            </div>
                        @endif

                        <el-button plain size="mini" style="margin-top: 10px;">
                            Follow {{ $artwork->user->name }}</el-button>
                    </div>

                    <div class="artist-artworks">
                        Artworks
                    </div>

                </div>

                <div class="artwork">

                    <div class="artwork--top">

                        <artwork-show-carousel artwork_="{{ $artwork }}"></artwork-show-carousel>

                        <div class="artwork--right">
                            <el-card class="artwork-description">

                                <div class="artwork-name">{{ $artwork->name }} by <a
                                            href="{{ route('artist', $artwork->user->id) }}"><b>{{ $artwork->user->name }}</b></a>
                                </div>

                                @if($artwork->user->country)
                                    <div class="artwork-country">
                                        Location: {{ $artwork->user->country['country_name'] }}
                                    </div>
                                @endif

                                @if($artwork->availableInStockWithQuantity() !== 'available')
                                    <div class="artwork-status">
                                        {{ trans('stock-status.' . $artwork->availableInStockWithQuantity()) }}
                                    </div>
                                @else
                                    <div class="artwork-status available">
                                        {{ trans('stock-status.' . $artwork->availableInStockWithQuantity()) }}
                                    </div>

                                    @if($artwork->quantity > 1)
                                        <div class="artwork-qty">
                                            Qty: {{ $artwork->quantity }} pc
                                        </div>
                                    @endif

                                    {{--<el-input-number size="mini" value="1" :min="Number('1')"--}}
                                    {{--:max="Number('{{ $artwork->quantity }}')"></el-input-number>--}}

                                @endif


                                <div class="artwork-price">
                                    {{ $artwork->formatted_price }}
                                </div>

                                @if(!$artwork->sold && $artwork->available)

                                    <a href="{{ route('cart.item.buy-now', $artwork->id) }}"
                                       class="el-button el-button--default is-plain artwork-buy">Buy Now</a>

                                    <a href="{{ route('cart.item.add', $artwork->id) }}"
                                       class="el-button el-button--primary artwork-add">Add to cart</a>
                                @endif

                                <div class="artwork-favorite">
                                    @if(auth()->user() && auth()->user()->favoriteArtworks->contains('id', $artwork->id))
                                        <el-tag type="info">Artwork is added to Favorite</el-tag>

                                        <el-button type="text">
                                            <a href="{{ route('favorite.toggle', $artwork->id) }}">Remove</a>
                                        </el-button>
                                    @else
                                        <el-button style="display: block;width: 100%;">
                                            <a href="{{ route('favorite.toggle', $artwork->id) }}">Add to Favorite <i
                                                        class="el-icon-star-off"></i></a>
                                        </el-button>
                                    @endif
                                </div>


                                <social-sharing inline-template quote="Quote here" url="{{ url()->current() }}"
                                                title="Title here" description="Description here">
                                    <div class="artwork-share">
                                        <el-button size="mini">
                                            <network network="facebook">
                                                <i class="fa fa-fw fa-facebook"></i> Share
                                            </network>
                                        </el-button>

                                        <el-button size="mini">
                                            <network network="googleplus">
                                                <i class="fa fa-fw fa-google-plus"></i> Share
                                            </network>
                                        </el-button>

                                        <el-button size="mini">
                                            <network network="twitter">
                                                <i class="fa fa-fw fa-twitter"></i> Tweet
                                            </network>
                                        </el-button>

                                    </div>
                                </social-sharing>

                            </el-card>

                            <el-card style="margin-bottom: 20px;">

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
                                        <img src="/imagecache/fit-25/{{ $artwork->user->avatar_url}}"/>
                                    </span>

                                    {{ $artwork->user->name }}
                                </a>
                            </el-card>

                            <el-card>
                                <div class="h4">
                                    Shipping & returns
                                </div>

                                <div class="p">
                                    Ready to ship in 1–2 business days
                                </div>

                                <div class="p">
                                    From {{ $artwork->user->country['country_name'] }}
                                </div>

                                <div class="p">
                                    Free shipping to {{ geoip(request()->ip())->country }}
                                </div>

                                <div class="p">
                                    See
                                    <a href="{{ route('page', 'freight')}}">Shipping</a> and
                                    <a href="{{ route('page', 'right-of-cancellation')}}">Rights to Cancellation</a>
                                </div>

                            </el-card>


                        </div>

                    </div>


                </div>


            </div>

        </div>
    @endif

@endsection