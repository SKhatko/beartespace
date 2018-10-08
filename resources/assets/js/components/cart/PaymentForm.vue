<template>

    <el-card class="box-card">
        <div slot="header" class="h4">
            <div style="margin-bottom: 10px;">Enter your payment details</div>
            <div class="small">Your will not be charged until you review this order on the next page.</div>
        </div>

        <slot></slot>

        <el-form id="payment-form" method="POST" action="/cart/payment">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" id="payment" name="payment">

            <div id="bt-dropin"></div>

            <el-button type="primary" native-type="submit" :loading="loading" style="margin-top: 20px;width: 100%;">
                Review your order
            </el-button>

        </el-form>


    </el-card>


</template>

<script>


    export default {
        props: {
            authorization_: '',
        },
        data() {
            return {
                loading: false,
                csrf: '',
            }
        },
        mounted() {
            this.csrf = window.csrf;

            var form = document.querySelector('#payment-form');
            braintree.create({
                authorization: this.authorization_,
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
                    this.loading = true;
                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            this.loading = false;
                            console.log('Request Payment Method Error', err);
                            return;
                        }

                        console.log(payload, 'payload');
                        // Add the nonce to the form and submit
                        document.querySelector('#payment').value = payload.nonce;
                        console.log(form);
                        form.submit();
                    });
                });
            });

        },
        methods: {}
    }
</script>

