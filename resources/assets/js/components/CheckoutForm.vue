<template>


    <el-card class="box-card checkout-payment">
        <div slot="header" class="h4">
            <div style="margin-bottom: 10px;">Enter your payment details</div>
            <div class="small">Your will not be charged until you review this order on the next page.</div>
        </div>


        <div class="checkout-payment-form">

            <el-form id="payment-form" method="POST" action="">
                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" id="nonce" name="nonce">

                <div id="bt-dropin"></div>

                <el-button type="primary" style="width: 100%" native-type="submit">Review your order</el-button>

                <el-input></el-input>

                <el-form-item>
                    <el-input></el-input>
                </el-form-item>
            </el-form>


            <slot></slot>

            <div class="checkout-payment-price">
                Order total: {{ formattedPrice_ }}
            </div>

            <div class="el-form-item checkout-payment-buttons">
                <el-radio v-model="paymentOption" label="paypal">Paypal</el-radio>
                <el-radio v-model="paymentOption" label="stripe">Credit or Debit Card</el-radio>
            </div>

            <div class="checkout-payment-paypal" v-show="paymentOption === 'paypal'">
                <el-button type="primary" @click="paypal" :loading="loading">Pay with PayPal</el-button>
            </div>

            <el-form ref="stripe-form" v-show="paymentOption === 'stripe'">
                <input type="hidden" name="_token" :value="csrf">

                <el-form-item>
                    <!--<card class="el-form-item__content"-->
                    <!--:class='{ complete }'-->
                    <!--:stripe='key_'-->
                    <!--:options='stripeOptions'-->
                    <!--@change='complete = $event.complete'/>-->

                    <div class="el-form-item__error">{{ error }}</div>

                </el-form-item>

                <el-button type="primary" @click='stripe' style="margin-top: 20px;" :loading="loading">Pay with credit
                    card
                </el-button>

            </el-form>


        </div>

    </el-card>


</template>

<script>

    import {Card, createToken} from 'vue-stripe-elements-plus'

    export default {
        props: {
            key_: '',
            price_: 0,
            formattedPrice_: ''
        },
        components: {Card},
        data() {
            return {
                loading: false,
                csrf: '',
                error: '',
                paymentOption: null,
                complete: false,
                stripeOptions: {
                    // see https://stripe.com/docs/stripe.js#element-options for details
                }
            }

        },
        mounted() {
            this.csrf = window.csrf;

            // let button = document.querySelector('#submit-button');
            // window.braintree.create({
            //     authorization: 'sandbox_9qqqx29m_8zf5jpxstv3pkjwy',
            //     container: '#dropin-container'
            // }, function (createErr, instance) {
            //     button.addEventListener('click', function () {
            //         instance.requestPaymentMethod(function (requestPaymentMethodErr, payload) {
            //             console.log(requestPaymentMethodErr,'err');
            //             console.log(payload,'payload');
            //             // Submit payload.nonce to your server
            //         });
            //     });
            // });

            var form = document.querySelector('#payment-form');
            braintree.create({
                authorization: 'sandbox_9qqqx29m_8zf5jpxstv3pkjwy',
                selector: '#bt-dropin',

                card: {
                    cardholderName: true,
                },
                paypal: {
                    flow: 'vault',
                    buttonStyle: {
                        label: 'paypal',
                        shape: 'rect',
                        size: 'medium'
                    }

                }
            }, function (createErr, instance) {
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }

                        console.log(payload, 'payload');
                        // Add the nonce to the form and submit
                        document.querySelector('#nonce').value = payload.nonce;
                        console.log(form);
                        form.submit();
                    });
                });
            });

        },
        methods: {
            stripe() {
                this.loading = true;
                createToken().then(data => {
                    if (data.error) {
                        this.error = data.error.message;
                        console.log(data.error.message);
                        this.loading = false
                    }

                    if (data.token) {
                        // this.stripeToken = 'tok_1DB17yFwuOiaBR7w2HtovVky';
                        // this.$refs['stripe-form'].$el.submit();
                        window.location.href = '/checkout/' + data.token.id;
                    }

                }).catch(error => {
                    console.log(error, 'error');
                    this.loading = false;
                })
            },

            paypal() {
                alert('Paypal is not connected, use Debit Cart checkout (Stripe)');
                console.log('paypal');
                // this.loading = true;
            },
        }
    }
</script>

