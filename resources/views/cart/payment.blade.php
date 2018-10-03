@extends('layouts.simple')

@section('content')

    <el-main class="app--wrapper">

        <div class="app-cart-payment">

            <!-- TODO input generated token -->
            <checkout-form
                    authorization_="{{ config('services.stripe.key') }}">
                @include('partials.errors')
            </checkout-form>

        </div>

    </el-main>

@stop
