<template>

    <el-main class="app-checkout">

        <el-card class="box-card app-checkout-address" style="">
            <div slot="header" class="clearfix">Where should we deliver your order?</div>

            <el-form :model="address" status-icon :rules="rules" ref="address">
                <el-form-item prop="country">
                    <el-select value="" v-model="address.country" filterable
                               placeholder="Select country">
                        <el-option
                                v-for="country in countries"
                                :key="country.id"
                                :label="country.country_name"
                                :value="country.id">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item prop="address">
                    <el-input placeholder="Address" v-model="address.address"></el-input>
                </el-form-item>

                <el-form-item prop="optional_address">
                    <el-input placeholder="Optional Address" v-model="address.address_2"></el-input>
                </el-form-item>

                <el-form-item prop="city">
                    <el-input placeholder="City" v-model="address.city"></el-input>
                </el-form-item>

                <el-row :gutter="20">
                    <el-col :span="16">
                        <el-form-item prop="region">
                            <el-input placeholder="State / Region / Province" v-model="address.region"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">
                        <el-form-item prop="postcode">
                            <el-input placeholder="Postcode" v-model="address.postcode"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item prop="phone">
                    <el-input placeholder="Phone" v-model="address.phone"></el-input>
                </el-form-item>

                <el-form-item prop="email">
                    <el-input placeholder="Email" v-model="address.email"></el-input>
                </el-form-item>

                <el-form-item prop="phone">
                    <el-input placeholder="Phone" v-model="address.phone"></el-input>
                </el-form-item>

                <el-button @click="submit">Go to checkout</el-button>

            </el-form>

        </el-card>
    </el-main>

</template>

<script>
    export default {
        data() {
            return {
                address: {
                    country: '',
                    address: '',
                    address_2: '',
                    city: '',
                    region: '',
                    postcode: '',
                    email: '',
                    phone: '',
                },
                countries: '',
                rules: {
                    country: [
                        {required: true, message: 'Please select country', trigger: 'blur'}
                    ],
                    address: [
                        {required: true, message: 'Please enter address', trigger: 'blur'}
                    ],
                    city: [
                        {required: true, message: 'Please enter city', trigger: 'blur'}
                    ],
                    region: [
                        {required: true, message: 'Please enter region', trigger: 'blur'}
                    ],
                    postcode: [
                        {required: true, message: 'Please enter postcode', trigger: 'blur'}
                    ],
                    email: [
                        {required: true, type: 'email', message: 'Please enter valid email', trigger: 'blur'}
                    ],
                    phone: [
                        {required: true, message: 'Please enter valid phone number', trigger: 'blur'}
                    ]
                },

            }
        },
        mounted() {
            axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });
        },
        methods: {
            submit() {
                this.$refs['address'].validate((valid) => {
                    if (valid) {
                        axios.post('/api/checkout/address', this.address)
                            .then(response => {
                                console.log(response.data);
                            })
                            .catch(error => {
                                console.log(error.response);
                            });
                        console.log(this.address);
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>