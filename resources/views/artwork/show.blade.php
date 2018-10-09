@extends('layouts.app')

@section('title') @if( ! empty($title)) {{ $title }} | @endif @parent @endsection

@section('content')

    <div class="app--wrapper">

        <div class="app-artwork">

            <div class="artist">
                <div class="artist-info">
                    <img src="/imagecache/fit-75{{ $artwork->user->avatar_url }}" class="artist-avatar" alt="">
                    <a href="{{ route('artist', $artwork->user->id) }}"
                       class="artist-name">{{ $artwork->user->name }}</a>

                    @if($artwork->user->followedBy->count() > 0)
                        <div class="artist-followed">
                            Followed by {{ $artwork->user->followedBy->count() }} people
                        </div>
                    @endif

                    @if(auth()->user())
                        <follow-button
                                follow_="{{ auth()->user()->followedUsers->contains($artwork->user->id) }}"
                                user-id_="{{ $artwork->user->id }}">
                            {{ $artwork->user->name }}
                        </follow-button>
                    @endif
                </div>

                @if($artwork->user->artworks->count() > 3)
                    <div class="artist-artworks hidden-xs-only">
                        @foreach($artwork->user->artworks->take(3) as $userArtwork)
                            <a href="{{ route('artwork', $userArtwork->id) }}" class="artist-artwork">
                                <img src="/imagecache/fit-75{{ $userArtwork->image_url }}" alt="">
                            </a>
                        @endforeach
                        <a href="{{ route('artist', $artwork->user->id) }}" class="artist-artwork">
                                <span>
                                       <span class="h2" style="display: block;">
                                          {{ $artwork->user->artworks->count() }}
                                    </span><br>
                                Artworks
                                </span>
                        </a>
                    </div>
                @endif

            </div>

            <div class="artwork">

                <div class="artwork--left">

                    <artwork-show-carousel artwork_="{{ $artwork }}"></artwork-show-carousel>

                    <el-collapse v-model="activeCollapseArtworkShow">
                        <el-collapse-item title="Description" name="description">
                            {{ $artwork->description }}
                        </el-collapse-item>
                        <el-collapse-item title="Inspiration" name="inspiration">

                            {{ $artwork->inspiration }}
                        </el-collapse-item>
                    </el-collapse>

                </div>

                <div class="artwork--right">
                    <el-card class="artwork-description">

                        <div class="artwork-name">{{ $artwork->name }} by
                            <b>{{ $artwork->made_by ?? $artwork->user->name }}</b>
                        </div>

                        <div class="artwork-price">
                            {{ $artwork->formatted_price }}
                        </div>

                        <div class="artwork-shipping">
                            Free shipping @if($artwork->processing_time)
                                within {{ $artwork->processing_time }} @endif
                        </div>

                        @if($artwork->statusString() !== 'available')
                            <div class="artwork-status">
                                {{ trans('stock-status.' . $artwork->statusString()) }}
                            </div>
                        @else
                            <div class="artwork-status available">
                                {{ trans('stock-status.' . $artwork->statusString()) }}
                            </div>

                            @if($artwork->quantity > 1)
                                <div class="artwork-qty" style="margin-bottom: 10px;">
                                    Qty: {{ $artwork->quantity }} pc
                                </div>
                            @endif

                            {{--<el-input-number size="mini" value="1" :min="Number('1')"--}}
                            {{--:max="Number('{{ $artwork->quantity }}')"></el-input-number>--}}

                        @endif

                        @if($artwork->statusString() === 'available')

                            <a href="{{ route('cart.item.buy-now', $artwork->id) }}"
                               class="el-button el-button--default is-plain artwork-buy">Buy Now</a>

                            <a href="{{ route('cart.item.add', $artwork->id) }}" style="margin-bottom: 20px;"
                               class="el-button el-button--primary artwork-add">Add to cart</a>
                        @endif

                        @if($artwork->favoredUsers()->count() > 1 )
                            <div class="artwork-favored">
                                <i class="el-icon-info"></i> <b>Almost
                                    gone.</b> {{ $artwork->favoredUsers()->count() }} people watch it
                            </div>
                        @endif

                        <social-sharing
                                inline-template quote="Quote here"
                                url="{{ url()->current() }}"
                                title="Title here"
                                description="Description here"
                                quote="See more quote"
                                hashtags="art,tags,hashtags"
                                twitter-user="twitterUserTest">
                            <div class="artwork-share">
                                <network network="facebook" class="facebook">
                                    <i class="icon-facebook"></i>
                                </network>

                                <network network="googleplus"
                                         class="google">
                                    <i class="icon-googleplus"></i>
                                </network>

                                <network network="twitter" class="twitter">
                                    <i class="icon-twitter"></i>
                                </network>

                                <network network="linkedin" class="linkedin">
                                    <i class="icon-linkedin"></i>
                                </network>

                                <network network="email" class="email">
                                    <i class="el-icon-message"></i>
                                </network>
                            </div>
                        </social-sharing>


                    </el-card>

                    <el-card style="margin-bottom: 20px;">

                        <div slot="header">Overview:</div>

                        <div class="artwork-overviews">

                            @if($artwork->height)
                                <div>Height: {{ $artwork->height }} cm</div>
                            @endif

                            @if($artwork->width)
                                <div>Width: {{ $artwork->width }} cm</div>
                            @endif

                            @if($artwork->depth)
                                <div>Depth: {{ $artwork->depth }} cm</div>
                            @endif

                            @if($artwork->weight)
                                <div>Weight: {{ $artwork->weight }} g</div>
                            @endif

                        <!-- Optional -->
                            @if($artwork->b_height)
                                <div>Total Height: {{ $artwork->b_height }} cm</div>
                            @endif

                            @if($artwork->b_width)
                                <div>Total Width: {{ $artwork->b_width }} cm</div>
                            @endif

                            @if($artwork->b_depth)
                                <div>Total Depth: {{ $artwork->b_depth }} cm</div>
                            @endif

                            @if($artwork->b_weight)
                                <div>Total Weight: {{ $artwork->b_weight }} cm</div>
                            @endif

                            @if($artwork->date_of_completion)
                                <div>Completion date: {{ $artwork->date_of_completion->year }}</div>
                            @endif

                            <div class="artwork-category">
                                Category: {{ trans('category.' . $artwork->category) }}
                            </div>

                            <div class="artwork-medium">
                                Materials: @foreach($artwork->medium as $medium)
                                    {{ trans_input('medium.' . $medium ) }},
                                @endforeach
                            </div>

                            <div class="artwork-direction">
                                Art Direction: @foreach($artwork->direction as $direction)
                                    {{ trans_input('direction.' . $direction ) }},
                                @endforeach
                            </div>

                            <div class="artwork-theme">
                                Theme: @foreach($artwork->theme as $theme)
                                    {{ trans_input('theme.' . $theme ) }},
                                @endforeach
                            </div>

                            {{--                                    {{ $artwork->color }}--}}
                            {{--                                    {{ $artwork->shape }}--}}

                        </div>


                    </el-card>

                    <el-card>
                        <div slot="header">Shipping & returns</div>

                        @if($artwork->processing_time)
                            <div>Ready to ship in {{ $artwork->processing_time }}</div>
                        @endif

                        @if($artwork->country)
                            <div class="artwork-country">
                                Shipping from <b>{{ $artwork->country['country_name'] }}</b>
                            </div>
                        @endif

                        <div class="artwork-country">
                            Free shipping to <b>{{ geoip(request()->ip())->country }}</b>
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

        <div class="app-artwork-other">
            <div class="h3">Other Artworks</div>
            <artworks-block artworks_="{{ $artwork->user->artworks->take(4) }}"></artworks-block>
        </div>

        <div class="app-artwork-similar">
            <div class="h3">You also might like</div>
            <artworks-block artworks_="{{ $artwork->user->artworks->take(4) }}"></artworks-block>
        </div>


    </div>

@endsection