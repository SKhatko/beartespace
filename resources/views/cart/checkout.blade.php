@extends('layouts.simple')

@section('content')

    <el-main class="app--wrapper">

        <div class="app-cart-checkout">

            <el-card class="box-card checkout-address">
                <div slot="header" class="h4">Delivery Address</div>

                <div class="h5">{{ $address->name }}</div>
                <div class="p" style="max-width: 400px;">{{ $address->address_string }}</div>

                <el-button style="margin-top: 10px;">
                    <a href="{{ route('address') }}">Edit delivery address</a>
                </el-button>

            </el-card>

            <el-card class="box-card checkout-cart">
                <div slot="header" class="h4">Review items</div>

                @foreach(Cart::content() as $artwork)

                    <div class="checkout-cart-item">
                        <img src="/imagecache/height-100{{ $artwork->model->image_url }}" alt=""
                             style="margin-right: 20px;">
                        <a href="{{ route('artwork', $artwork->id) }}">{{ $artwork->name . ' - ' . $artwork->model->formatted_price }}
                            {{ $artwork->qty }}pc</a>
                    </div>

                @endforeach

                <el-button style="margin-top: 10px;">
                    <a href="{{ route('cart') }}">Edit items</a>
                </el-button>

            </el-card>

        </div>

    </el-main>

@stop
