@extends('layouts.cart-checkout')

@section('cart-checkout-status')
    <el-steps :active="2" align-center finish-status="success" class="app-header-cartcheckout">
        <el-step description="Shipping"></el-step>
        <el-step description="Payment"></el-step>
        <el-step description="Review"></el-step>
    </el-steps>
@endsection

@section('content')

    <el-main class="app--wrapper">

        <div class="app-cart-checkout">

            <el-card>
                <div slot="header" class="h4">Please confirm and submit your order</div>

                @include('partials.errors')

                <div class="checkout">

                    <div class="checkout-address">
                        <div class="h5">Shipping Address <a href="{{ route('cart.shipping') }}"
                                                            class="el-button el-button--default el-button--small">
                                Edit
                            </a></div>

                        <div class="p">{{ $address->address_string }}</div>

                    </div>

                    <div class="checkout-payment">
                        <div class="h5">Payment method <a href="{{ route('cart.payment') }}"
                                                          class="el-button el-button--default el-button--small">Edit</a>
                        </div>

                        <div class="checkout-payment-method">
                            <img src="{{ $paymentMethod->imageUrl }}" alt="" style="margin-right: 10px;">

                            <div class="details">
                                <div>*{{ $paymentMethod->last4 }}</div>
                                <div>{{ $paymentMethod->expirationMonth . ' / ' . $paymentMethod->expirationYear }}</div>
                            </div>
                        </div>

                    </div>

                    <div class="checkout-total">
                        <el-card>
                            <div class="checkout-total-vat">
                                <span>Item total (incl. VAT)</span>
                                <span>{{ currency(Cart::total()) }}</span>
                            </div>
                            <hr>
                            <div class="checkout-total-summary">
                                <span>Order total ({{ Cart::count() }})</span>
                                <span>{{ currency(Cart::total()) }}</span>
                            </div>

                            <el-form action="/cart/checkout" method="POST">
                                {{ csrf_field() }}

                                <el-button type="primary" native-type="submit" style="width: 100%;"
                                           v-loading.fullscreen.lock="fullScreenLoading"
                                           @click="fullScreenLoading = true">Pay Now
                                </el-button>
                            </el-form>
                        </el-card>

                        <div class="checkout-total-bottom">
                            By clicking Pay Now, you agree to BearteSpace's <a href="/page/terms">Terms of Use</a> and
                            <a href="/page/privacy">Privacy Policy</a>
                        </div>


                    </div>
                </div>


            </el-card>


            <el-card class="box-card checkout-cart">
                <div slot="header" class="h4">Review items</div>

                @include('cart.cart-items', ['cart' => Cart::content()])

            </el-card>

        </div>

    </el-main>

@stop
