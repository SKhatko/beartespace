@extends('layouts.cart-checkout')

@section('cart-checkout-status')
    <el-steps :active="1" align-center finish-status="success" class="app-header-cartcheckout">
        <el-step description="Shipping"></el-step>
        <el-step description="Payment"></el-step>
        <el-step description="Review"></el-step>
    </el-steps>
@endsection

@section('content')

    <el-main class="app--wrapper">

        <div class="app-cart-payment">

            <!-- TODO input generated token -->
            <cart-payment-form
                    authorization_="{{ $clientToken }}">
                @include('partials.errors')
            </cart-payment-form>

        </div>

    </el-main>

@stop
