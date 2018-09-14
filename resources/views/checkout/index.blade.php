@extends('layouts.simple')

@section('content')

    <el-main class="app--centered">

        <div class="app-checkout">
            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Checkout</el-breadcrumb-item>
            </el-breadcrumb>

            <el-card class="box-card checkout-payment">
                <div slot="header" class="h4">Select a payment method</div>

                <div class="checkout-payment-price">
                    Order total: {{ currency(Cart::total(), null, session('currency')) }}
                </div>

                <checkout-form
                        price_="{{ Cart::total() }}"
                        formatted-price_="{{ currency(Cart::total(), null, session('currency')) }}"
                        key_="{{ config('services.stripe.key') }}">
                </checkout-form>

                <div class="checkout-payment-stripe">

                    {{--<form action="/checkout/pay" method="POST">--}}
                    {{--{{ csrf_field() }}--}}

                    {{--<script type="application/javascript"--}}
                    {{--src="https://checkout.stripe.com/checkout.js" class="stripe-button"--}}
                    {{--data-key="pk_test_hRbzarBjU9kEvjlNLAdqm5he"--}}
                    {{--data-amount="999"--}}
                    {{--data-name="Demo Site"--}}
                    {{--data-description="Example charge"--}}
                    {{--data-image="https://stripe.com/img/documentation/checkout/marketplace.png"--}}
                    {{--data-locale="auto"--}}
                    {{--data-currency="eur">--}}
                    {{--</script>--}}
                    {{--</form>--}}
                    {{--<form action="/checkout/pay" method="post" id="payment-form">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="el-form-item">--}}
                    {{--<label class="el-form-item__label">--}}
                    {{--Credit or debit card--}}
                    {{--</label>--}}

                    {{--<div id="card-element">--}}
                    {{--<!-- A Stripe Element will be inserted here. -->--}}
                    {{--</div>--}}

                    {{--<!-- Used to display form errors. -->--}}
                    {{--<div id="card-errors" class="checkout-payment-stripe__errors" role="alert"></div>--}}
                    {{--</div>--}}

                    {{--Press enter to submit the form--}}

                    {{--<button class="el-button el-button--primary" id="submit-button">--}}
                    {{--Pay with Card--}}
                    {{--</button>--}}
                    {{--</form>--}}
                </div>

            </el-card>

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

@endsection