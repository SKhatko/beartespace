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

                                <a href="{{ route('artist', $artwork->model->user_id) }}" class="h5"
                                   style="margin-bottom: 6px;font-weight: bold;display: block;">
                                    {{ $artwork->model->user->name }}
                                </a>

                                <a href="{{ route('artwork', $artwork->id) }}" class="h5">
                                    {{ $artwork->name }}
                                </a>
                            </div>

                            <div class="cart-item--right">
                                @if($artwork->model->availableInStockWithQuantity($artwork->qty) === 'available')

                                    <div class="cart-item-price">
                                        {{ $artwork->model->formatted_price }}
                                    </div>

                                    <div class="cart-item-qty">
                                        {{ $artwork->qty }} pc
                                    </div>

                                @else
                                    <div class="cart-item-status">
                                        @lang('stock-status.' . $artwork->model->stockStatus)
                                    </div>
                                @endif

                                <el-button circle style="margin-left: 10px;">
                                    <a href="{{ route('cart.item.remove', $artwork->model->id) }}"><span
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