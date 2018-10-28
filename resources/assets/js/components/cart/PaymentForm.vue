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

            <el-form-item>
                <div id="bt-dropin"></div>
                <div class="el-form-item__error">{{ errorMessage }}</div>
            </el-form-item>

            <div class="app--fixed-bottom">
                <div class="app--wrapper">
                    <el-button type="primary" native-type="submit" :loading="loading">
                        Review your order
                    </el-button>
                </div>
            </div>

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
                errorMessage: '',
                csrf: '',
            }
        },
        mounted() {
            this.csrf = window.csrf;

            let form = document.querySelector('#payment-form');
            let vm = this;

            braintree.create({
                authorization: this.authorization_,
                selector: '#bt-dropin',
                vaultManager: true,
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

                },
            }, function (createErr, instance) {
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    vm.loading = true;
                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            vm.loading = false;
                            vm.errorMessage = err.message;
                            console.log('Request Payment Method Error', err);
                            return;
                        }

                        // console.log(payload, 'payload');
                        // Add the nonce to the form and submit
                        document.querySelector('#payment').value = payload.nonce;
                        form.submit();
                    });
                });
            });

        },
        methods: {}
    }
</script>

