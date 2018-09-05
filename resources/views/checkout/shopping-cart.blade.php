@extends('layouts.app')

@section('content')

    <el-main class="app-checkout">

        <el-card class="box-card app-checkout-cart" style="">
            <div slot="header" class="clearfix">Shopping cart</div>

            @if(Cart::content()->count() > 0)

                @foreach(Cart::content() as $artwork)
                    <el-row :gutter="20" style="margin-bottom:20px;" type="flex" align="middle">

                        <el-col :sm="8">
                            <img src="/imagecache/height-100{{ $artwork->options->image_url }}" alt=""
                                 style="height: 100px;">
                        </el-col>

                        <el-col :sm="10">
                            <a href="{{ route('artwork', $artwork->id) }}" class="h4">
                                {{ $artwork->name }}
                            </a>
                        </el-col>
                        <el-col :sm="6" style="text-align: right;">
                            <div class="h4">
                                {{ currency($artwork->price, null, session('currency')) }}

                                <el-button circle style="margin-left: 10px;">
                                    <a href="{{ route('cart.item.remove', $artwork->id) }}"><span
                                                class="el-icon-delete"></span></a>
                                </el-button>
                            </div>

                        </el-col>
                    </el-row>

                @endforeach

                <hr style="margin-bottom: 20px;">

                <el-row :gutter="20" style="margin-bottom: 30px;">
                    <el-col :span="18">
                        <span class="h4">
                            Subtotal
                        </span>
                    </el-col>
                    <el-col :span="6" style="text-align: right;">
                        <span class="h4">
                            {{ currency(Cart::subtotal(), null, session('currency')) }}
                        </span>
                    </el-col>
                </el-row>

                {{--<el-button type="success"><a href="{{ route('checkout') }}">Checkout</a></el-button>--}}
                <el-button type="success"><a href="{{ route('checkout.address') }}">Continue</a></el-button>

            @else

                <div class="h3">
                    Cart is empty
                </div>

            @endif

            <el-button><a href="{{ route('artworks') }}">Continue shopping</a></el-button>
        </el-card>
    </el-main>

@stop