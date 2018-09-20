@extends('layouts.simple')

@section('content')

    <el-main class="app--centered">

        <div class="app-checkout">
            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Checkout</el-breadcrumb-item>
            </el-breadcrumb>

            <checkout-form
                    price_="{{ $totalPrice }}"
                    formatted-price_="{{ $totalFormattedPrice }}"
                    key_="{{ config('services.stripe.key') }}">
            </checkout-form>

            <el-card class="box-card checkout-address">
                <div slot="header" class="h4">Delivery Address</div>

                <div class="h5">{{ $address->name }}</div>
                <div class="p" style="max-width: 400px;">
                    {{ $address->country->country_name }},
                    {{ $address->city }},
                    {{ $address->region }},
                    {{ $address->postcode }},
                    {{ $address->address }},
                    {{ $address->address_2 }},
                    {{ $address->email }},
                    {{ $address->phone }}
                </div>

                <el-button style="margin-top: 10px;">
                    <a href="{{ route('address') }}">Edit delivery address</a>
                </el-button>

            </el-card>

            <el-card class="box-card checkout-cart">
                <div slot="header" class="h4">Review items</div>

                @foreach($artworks as $artwork)

                    <div class="checkout-cart-item">
                        <img src="/imagecache/height-100{{ $artwork->image_url }}" alt="" style="margin-right: 20px;">
                        {{ $artwork->title . ' - ' . $artwork->price }}
                    </div>

                @endforeach

                <el-button style="margin-top: 10px;">
                    <a href="{{ route('cart') }}">Edit items</a>
                </el-button>

            </el-card>

        </div>

    </el-main>

@stop

@section('script')

    <script src="https://js.stripe.com/v3/"></script>

@endsection