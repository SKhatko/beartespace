<template>
    <div class="checkout-payment-buttons">
        <el-button type="primary" @click="paypal">Paypal</el-button>
        <el-button type="primary" @click="stripe">Credit or Debit Cart</el-button>
        <el-form ref="stripe-payment-form" action="/checkout/pay">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="stripe-token" v-model="token">
        </el-form>
    </div>
</template>

<script>

    export default {
        props: {
            key_: '',
            price_: 0,
            formattedPrice_: ''
        },
        data() {
            return {
                csrf: '',
                token: '',
            }

        },

        mounted() {
            console.log(this.key_);
            console.log(Number(this.price_) * 100);
            this.csrf = window.csrf;
        },

        methods: {

            paypal() {
                console.log('paypal');
                console.log(this.$checkout);
            },

            stripe() {
                // this.$checkout.close()
                // is also available.
                this.$checkout.open({
                    image: '/images/b-favicon-64.png',
                    locale: 'auto',
                    currency: window.cfg.currency,
                    name: 'Buy artworks',
                    description: 'Description',
                    amount: Number(this.price_) * 100,
                    panelLabel: 'Pay ' + this.formattedPrice_,
                    token: (token) => {
                        this.token = token;
                        this.$refs['stripe-payment-form'].submit();
                        console.log(token, 'token');
                    }
                })
            },

        }
    }
</script>

