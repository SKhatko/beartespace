@extends('layouts.app')

@section('content')

    <el-main class="app--wrapper">

        <div class="app-cart">

            <el-card class="cart">
                <div slot="header">
                    <div class="cart-header">
                        <span>Shopping cart</span>
                        <a href="/" class="el-button el-button--default el-button--mini">Keep shopping</a>
                    </div>
                </div>

                @include('partials.errors')

                @if(Cart::count() > 0)
                    @include('cart.cart-items', ['cart' => Cart::content()])
               @else

                    <div class="cart-empty">
                        Your cart is empty. Let's get some art!

                        <a href="/" class="el-button el-button--default" style="margin-top: 20px;">Find art for the
                            soul</a>
                    </div>

                @endif


            </el-card>

            <el-card class="total">
                <div class="total-vat">
                    <span>Item total (incl. VAT)</span>
                    <span>{{ currency(Cart::total()) }}</span>
                </div>
                <hr>
                <div class="total-summary">
                    <span>Order total ({{ Cart::count() }})</span>
                    <span>{{ currency(Cart::total()) }}</span>
                </div>

                <a href="/cart/checkout" class="el-button el-button--primary" style="width: 100%;">Proceed to Checkout</a>
            </el-card>

        </div>


    </el-main>

@stop