<template>

    <el-card class="box-card address" style="">
        <div slot="header" class="h4">Where should we deliver your order?</div>

        <el-form :model="address" status-icon :rules="rules" ref="address" @submit.native.prevent="save" method="POST" action="/address">
            <input type="hidden" name="_token" :value="csrf">

            <el-form-item prop="country">
                <el-select value="" name="county" v-model="address.country" filterable
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
                <el-input placeholder="Address" name="address" v-model="address.address"></el-input>
            </el-form-item>

            <el-form-item prop="optional_address">
                <el-input placeholder="Optional Address" name="address_2" v-model="address.address_2"></el-input>
            </el-form-item>

            <el-form-item prop="city">
                <el-input placeholder="City" name="city" v-model="address.city"></el-input>
            </el-form-item>

            <el-row :gutter="20">
                <el-col :span="16">
                    <el-form-item prop="region">
                        <el-input placeholder="State / Region / Province" name="region" v-model="address.region"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item prop="postcode">
                        <el-input placeholder="Postcode" name="postcode" v-model="address.postcode"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-form-item prop="email">
                <el-input placeholder="Email" name="email" v-model="address.email"></el-input>
            </el-form-item>

            <input type="hidden" name="phone" v-model="address.phone">

            <el-form-item prop="phone">
                <vue-tel-input v-model="address.phone" :preferredCountries="['us', 'dk', 'ua']"></vue-tel-input>
            </el-form-item>


            <el-button native-type="submit">Go to checkout</el-button>
            <el-button type="text"><a href="/cart">Back to Cart</a></el-button>

        </el-form>

    </el-card>


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
                csrf: ''

            }
        },
        mounted() {
            this.csrf = window.csrf;

            axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });
        },
        methods: {
            save() {
                this.$refs['address'].validate((valid) => {
                    if (valid) {
                        this.$refs['address'].$el.submit();

                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>