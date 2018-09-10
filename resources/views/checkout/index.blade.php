@extends('layouts.simple')

@section('content')

    <el-main class="app--centered">

        <div class="app-checkout">
            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Checkout</el-breadcrumb-item>
            </el-breadcrumb>

            <checkout-form></checkout-form>


            {{--<form action="/checkout/pay" method="POST">--}}
                {{--{{ csrf_field() }}--}}

                {{--<script--}}
                        {{--src="https://checkout.stripe.com/checkout.js" class="stripe-button"--}}
                        {{--data-key="{{ config('services.stripe.key') }}"--}}
                        {{--data-amount="999"--}}
                        {{--data-name="Demo Site"--}}
                        {{--data-description="Example charge"--}}
                        {{--data-image="https://stripe.com/img/documentation/checkout/marketplace.png"--}}
                        {{--data-locale="auto"--}}
                        {{--data-currency="eur">--}}
                {{--</script>--}}
            {{--</form>--}}

            <form action="/charge" method="post" id="payment-form">
                <div class="form-row">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>

                <button>Submit Payment</button>
            </form>


        </div>

    </el-main>

@stop

@section('script')

    <script>

        var stripe = Stripe('pk_test_hRbzarBjU9kEvjlNLAdqm5he');
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: "#32325d",
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

    </script>

@endsection