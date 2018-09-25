<template>

    <el-main class="app--wrapper">

        <div class="app-address">

            <el-breadcrumb separator-class="el-icon-arrow-right" style="margin: 30px 0;">
                <el-breadcrumb-item><a href="/">Home</a></el-breadcrumb-item>
                <el-breadcrumb-item>Select Delivery Address</el-breadcrumb-item>
            </el-breadcrumb>

            <el-card class="box-card">
                <div slot="header" class="h4">Select delivery Address</div>

                <el-form :model="deliveryAddress" status-icon :rules="addressesRules" ref="addresses"
                         @submit.native.prevent="saveAddresses" method="POST"
                         :action="'/address/' + deliveryAddress.selected">
                    <input type="hidden" name="_token" :value="csrf">

                    <el-form-item prop="selected">
                        <el-radio-group v-model="deliveryAddress.selected">
                            <div v-for="address in addresses" :key="address.id">
                                <el-radio class="radio" :label="address.id">
                                    <span class="address">{{ address.address_string }}</span>
                                    <span class="address-edit" @click.prevent="edit(address)">Edit address</span>
                                </el-radio>
                            </div>

                        </el-radio-group>
                    </el-form-item>

                    <el-button type="text" @click="createAddress">Create new Address</el-button>

                    <!--<hr>-->
                    <div style="margin-top: 20px;">

                        <el-button type="primary" native-type="submit">Checkout</el-button>

                        <el-button type="warning"><a href="/cart">Back to Cart</a></el-button>

                    </div>

                </el-form>


            </el-card>

        </div>

        <el-dialog :visible.sync="showAddressForm" width="30%" title="Delivery Address"
                   :before-close="handleCloseDialog">

            <el-form :model="address" status-icon :rules="rules" ref="address"
                     @submit.native.prevent="save" method="POST" action="/address">
                <input type="hidden" name="_token" :value="csrf">

                <errors></errors>

                <el-form-item prop="name">
                    <el-input placeholder="Enter name for delivery" name="name" v-model="address.name"></el-input>
                </el-form-item>

                <el-form-item prop="country_id">
                    <el-select value="" name="country_id" v-model="address.country_id" filterable
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
                            <el-input placeholder="State / Region / Province" name="region"
                                      v-model="address.region"></el-input>
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

                <el-button native-type="submit" type="primary">Save</el-button>

            </el-form>

        </el-dialog>


    </el-main>


</template>

<script>
    export default {
        props: {
            addresses_: {},
            selected_: null,
        },
        data() {
            return {
                showAddressForm: false,
                deliveryAddress: {
                    selected: null,
                },
                addressesRules: {
                    selected: [
                        {required: true, message: 'Please select delivery address', trigger: 'blur'}
                    ]
                },
                addresses: {},
                address: {},
                countries: '',
                rules: {
                    name: [
                        {required: true, message: 'Please enter delivery name', trigger: 'blur'}
                    ],
                    country_id: [
                        {required: true, message: 'Please select country', trigger: 'blur'}
                    ],
                    address: [
                        {required: true, message: 'Please enter address', trigger: 'blur'}
                    ],
                    optional_address: [{}],
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

            if (this.addresses_) {
                this.addresses = JSON.parse(this.addresses_);
            }

            console.log(this.selected_, 'selected');

            if (this.selected_) {
                this.deliveryAddress.selected = Number(this.selected_);
            }

            if (!this.addresses.length) {
                this.showAddressForm = true;
            }

            console.log(this.addresses);
        },
        methods: {
            edit(address) {
                this.address = Object.assign({}, address);
                this.showAddressForm = true;
            },
            save() {
                this.$refs['address'].validate((valid) => {
                    if (valid) {
                        // this.$refs['address'].$el.submit();
                        axios.post('/api/address', this.address)
                            .then(response => {
                                console.log(response.data);
                                this.$message({
                                    showClose: true,
                                    message: response.data.message,
                                    type: response.data.status
                                });
                                this.addresses = response.data.data;
                                this.handleCloseDialog();
                            })
                            .catch(error => {
                                this.$store.commit('setErrors', error.response.data.errors);
                                console.log(error);
                            })
                    }
                })
            },
            saveAddresses() {
                this.$refs['addresses'].validate((valid) => {
                    if (valid) {
                        this.$refs['addresses'].$el.submit();

                    }
                })
            },
            handleCloseDialog() {
                this.$refs['address'].resetFields();
                this.showAddressForm = false;
            },
            getCountyName(id) {
                let countryName = '';
                if (this.countries.length) {
                    this.countries.map(country => {
                        if (country.id === id) {
                            countryName = country.country_name;
                        }
                    });
                }

                return countryName;
            },
            createAddress() {
                this.address = {};
                this.showAddressForm = true;
            }
        }
    }
</script>

<style scoped>

</style>