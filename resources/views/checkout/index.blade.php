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
                    10eur
                </div>

                <div class="checkout-payment-buttons">
                    <el-button type="primary" id="paypal-submit">Pay with Paypal</el-button>
                </div>

                <div class="p">or Pay with Mastercard / Visa</div>

                <div class="checkout-payment-stripe">
                    <form action="/checkout/pay" method="post" id="payment-form">
                        {{ csrf_field() }}

                        <div class="el-form-item">
                            <label class="el-form-item__label">
                                Credit or debit card
                            </label>

                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" class="checkout-payment-stripe__errors" role="alert"></div>
                        </div>

                        Press enter to submit the form

                        {{--<button type="submit" form="payment-form" class="el-button el-button--primary" id="submit-button">--}}
                            {{--Pay with Card--}}
                        {{--</button>--}}

                    </form>
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


        </div>

    </el-main>

@stop

@section('script')

    <script>

        // Create a Stripe client.
        var stripe = Stripe('{{ config('services.stripe.key') }}');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '18px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function (event) {
            console.log(event, 'event');
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');

        form.addEventListener('submit', function (event) {
            console.log(event, 'submit');
            event.preventDefault();

            stripe.createToken(card).then(function (result) {
                console.log(card);
                console.log(result);
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        var payWithPaypal = document.getElementById('paypal-submit');

        var submitButton = document.getElementById('submit-button');

        payWithPaypal.addEventListener("click", function (event) {
            alert("paypal");
            console.log(event);
        }, false);

        submitButton.addEventListener("click", function (event) {
            alert("something");

            event.preventDefault();

            return false;

        }, false);



    </script>


@endsection