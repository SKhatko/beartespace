@extends('layouts.app')

@section('content')

    <el-main class="app--centered">

        <div class="app-cart">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Shopping Cart</el-breadcrumb-item>
            </el-breadcrumb>

            <el-card class="box-card cart">
                <div slot="header" class="clearfix h4">Shopping cart</div>

                @if(Cart::count() > 0)

                    @foreach(Cart::content() as $artwork)

                        <div class="cart-item">
                            <div class="cart-item-image">
                                <img src="/imagecache/height-100{{ $artwork->model->image_url }}"
                                     alt="{{ $artwork->model->image ? $artwork->model->image->original_name : 'image' }}"
                                     style="height: 100px;">
                            </div>

                            <div class="cart-item-info">

                                <a href="{{ route('artist', $artwork->model->user->id) }}" class="cart-item-artist">
                                    <span class="cart-item-artist-avatar">
                                        <img src="/imagecache/mini-avatar/{{ $artwork->model->user->avatar_url}}"/>
                                    </span>

                                    {{ $artwork->model->user->name }}
                                </a>

                                <a href="{{ route('artist', $artwork->model->user_id) }}" class="h5">
                                    {{ $artwork->model->user->name }}
                                </a>

                                <a href="{{ route('artwork', $artwork->id) }}" class="h5">
                                    {{ $artwork->name }}
                                </a>

                                <a href="{{ route('cart.item.remove', $artwork->model->id) }}"
                                   style="display: block;margin-top: 10px;">Remove</a>
                            </div>

                            <div class="cart-item--right">


                                <div class="cart-item-qty">
                                    Qty: {{ $artwork->qty }}
                                </div>

                                @if($artwork->model->availableInStockWithQuantity($artwork->qty) === 'available')

                                    <div class="cart-item-price">
                                        {{ $artwork->model->formatted_price }}
                                    </div>

                                @else
                                    <div class="cart-item-status">
                                        @lang('stock-status.' . $artwork->model->availableInStockWithQuantity($artwork->qty))
                                    </div>
                                @endif
                            </div>

                        </div>

                    @endforeach

                    <div class="cart-bottom">
                        <div class="cart-bottom-info">
                            Subtotal
                        </div>
                        <div class="cart-bottom-price">
                            {{--                            {{ currency(Cart::total(), null, session('currency')) }} / --}}
                            {{ currency(Cart::total()) }}
                        </div>
                    </div>

                    {{--<el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>--}}
                    <el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>

                @else

                    <div class="h3" style="margin-bottom: 30px;">
                        You don't have any items in your cart. Let's get shopping!
                    </div>
                @endif

                <el-button><a href="{{ route('artworks') }}">Continue shopping</a></el-button>
            </el-card>

        </div>


    </el-main>

@stop