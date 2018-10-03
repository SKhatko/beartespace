@extends('layouts.app')

@section('content')

    <el-main class="app--wrapper">

        <div class="app-cart">

            <el-card class="box-card cart">
                <div slot="header">
                    <div class="cart-header">
                        <span>Shopping cart</span>
                        <a href="/" class="el-button el-button--default el-button--mini">Keep shopping</a>
                    </div>
                </div>

                @include('partials.errors')

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

                                <a href="{{ route('artwork', $artwork->id) }}" class="cart-item-description">
                                    {{ $artwork->name }}
                                </a>

                                <a href="{{ route('cart.item.remove', $artwork->model->id) }}" class="cart-item-remove">Remove</a>
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

                    <a href="{{ route('cart.checkout') }}" class="el-button el-button--primary">Checkout</a>

                @else

                    <div class="cart-empty">
                        Your cart is empty. Let's get some art!

                        <a href="/" class="el-button el-button--default" style="margin-top: 20px;">Find art for the
                            soul</a>
                    </div>
                @endif

            </el-card>

        </div>


    </el-main>

@stop