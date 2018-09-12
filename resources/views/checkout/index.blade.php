@extends('layouts.simple')

@section('content')

    <el-main class="app--centered">

        <div class="app-checkout">
            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Checkout</el-breadcrumb-item>
            </el-breadcrumb>

            <checkout-form>


                <el-form action="/checkout/pay" method="post" id="payment-form">
                    {{ csrf_field() }}

                    <el-form-item label="Credit or debit card">
                        <div id="card-element"></div>
                    </el-form-item>

                    <div class="form-row">
                        <label for="card-element">
                            Something here
                        </label>
                        <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                        </div>

                        <!-- Used to display Element errors. -->
                        <div id="card-errors" role="alert"></div>
                    </div>

                    <el-button>Submit</el-button>

                    <button>Submit Payment</button>
                </el-form>


            </checkout-form>

            <a href="{{ route('address') }}">Edit delivery address</a>



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

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });


        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    </script>

@endsection