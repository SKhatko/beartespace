<template>


    <el-card class="box-card checkout-payment">
        <div slot="header" class="h4">Select a payment method</div>

        <div class="checkout-payment-form">

            <div class="checkout-payment-price">
                Order total: {{ formattedPrice_ }}
            </div>

            <div class="el-form-item checkout-payment-buttons">
                <el-radio v-model="paymentOption" label="paypal">Paypal</el-radio>
                <el-radio v-model="paymentOption" label="stripe">Credit or Debit Card</el-radio>
            </div>

            <div class="checkout-payment-paypal" v-show="paymentOption === 'paypal'">
                <el-button type="primary" @click="paypal">Pay with PayPal</el-button>
            </div>

            <el-form ref="stripe-form" v-show="paymentOption === 'stripe'">
                <input type="hidden" name="_token" :value="csrf">

                <el-form-item>
                    <card class="el-form-item__content"
                          :class='{ complete }'
                          :stripe='key_'
                          :options='stripeOptions'
                          @change='complete = $event.complete'/>

                    <div class="el-form-item__error">{{ error }}</div>

                </el-form-item>

                <el-button type="primary" @click='stripe' style="margin-top: 20px;">Pay with credit card</el-button>

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
        },
        methods: {
            stripe() {
                createToken().then(data => {
                    if (data.error) {
                        this.error = data.error.message;
                        console.log(data.error.message);
                    }

                    if (data.token) {
                        // this.stripeToken = 'tok_1DB17yFwuOiaBR7w2HtovVky';
                        // this.$refs['stripe-form'].$el.submit();

                        window.location.href = '/checkout/' + data.token.id;
                    }

                }).catch(error => {
                    console.log(error, 'error');
                })
            },

            paypal() {
                console.log('paypal');
            },

            sttttripe() {
                // this.$checkout.close()
                // is also available.
                this.$checkout.open({
                    image: '/images/b-favicon-64.png',
                    locale: 'auto',
                    currency: window.cfg.currency,
                    name: 'BearteSpace',
                    description: 'Make purchase with credit or debit cart',
                    amount: Number(this.price_) * 100,
                    panelLabel: 'Pay ' + this.formattedPrice_,
                    token: (token) => {

                    }
                })
            },
        }
    }
</script>

