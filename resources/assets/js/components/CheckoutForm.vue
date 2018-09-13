<template>
    <el-card class="box-card checkout-payment">
        <div slot="header" class="h4">Select a payment method</div>

        <div class="checkout-payment-price">

            10eur
        </div>

        <div class="checkout-payment-buttons">
            <el-button type="primary" @click="payWithPaypal" >Pay with Paypal</el-button>
            <el-button type="primary" @click="showPayWithStripe = !showPayWithStripe">Pay with Mastercard / Visa</el-button>
        </div>

        <div class="checkout-payment-stripe" v-if="showPayWithStripe">
            <slot></slot>
        </div>

    </el-card>

    <!--<el-card class="box-card checkout-address" style="margin-top: 20px;">-->
        <!--<div class="h4" slot="header">-->
            <!--Ship to-->
        <!--</div>-->

        <!--Short address here-->

        <!--<el-button type="text"><a href="/address">Change address</a></el-button>-->

    <!--</el-card>-->

</template>

<script>
    export default {
        data() {
            return {
                showPayWithStripe: false,

            }
        },
        methods: {
            payWithPaypal() {
                console.log('payWithPaypal');
            }
        }
    }
</script>

<style scoped>

</style>