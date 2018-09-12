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

                @if($artworks)

                    @foreach($artworks as $artwork)
                        <div class="cart-item">

                            <div class="cart-item-image">
                                <img src="/imagecache/height-100{{ $artwork->image_url }}"
                                     alt="{{ $artwork->image ? $artwork->image->original_name : 'image' }}"
                                     style="height: 100px;">
                            </div>

                            <a href="{{ route('artwork', $artwork->id) }}" class="cart-item-info">
                                {{ $artwork->title }}
                            </a>

{{--                            {{ $artwork->unique ? 1 : $artwork->quantity }}--}}

{{--                            {{ $artwork->status }}--}}

                            <div class="cart-item-price">
                                {{ $artwork->formatted_price }}
                                {{--                                {{ currency($artwork->price, null, session('currency')) }}--}}

                                <el-button circle style="margin-left: 10px;">
                                    <a href="{{ route('cart.item.remove', $artwork->id) }}"><span
                                                class="el-icon-delete"></span></a>
                                </el-button>
                            </div>

                        </div>

                    @endforeach

                    <div class="cart-bottom">
                        <div class="cart-bottom-info">
                            Subtotal
                        </div>
                        <div class="cart-bottom-price">
                            {{ currency(Cart::subtotal(), null, session('currency')) }}
                        </div>
                    </div>

                    {{--<el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>--}}
                    <el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>

                @else

                    <div class="h3" style="margin-bottom: 30px;">
                        Cart is empty
                    </div>

                @endif

                <el-button><a href="{{ route('artworks') }}">Continue shopping</a></el-button>
            </el-card>

        </div>


    </el-main>

@stop