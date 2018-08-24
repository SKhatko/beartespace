<template>
    <el-main class="app-auth">

        <el-card class="box-card app-auth-register">
            <div slot="header" class="clearfix">New User Registration</div>

            <el-form label-position="top" :rules="rules" :model="user" ref="user" method="post" action="/register"
                     @submit.native.prevent="register">

                <errors></errors>

                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="user_type" v-model="user.user_type">

                <!--<el-row :gutter="20">-->
                    <!--<el-col>-->

                        <!--<el-form-item label="Select user type">-->

                            <!--<el-radio-group v-model="user.user_type" name="user_type">-->
                                <!--<el-radio-button name="user_type" label="user">Customer</el-radio-button>-->
                                <!--<el-radio-button name="user_type" label="artist">Artist</el-radio-button>-->
                                <!--<el-radio-button name="user_type" label="gallery">Gallery</el-radio-button>-->
                            <!--</el-radio-group>-->

                        <!--</el-form-item>-->
                    <!--</el-col>-->
                <!--</el-row>-->

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="First Name" prop="first_name">
                            <el-input name="first_name" v-model="user.first_name" autofocus></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="Last Name" prop="last_name">
                            <el-input name="last_name" v-model="user.last_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item label="E-Mail Address" prop="email">
                    <el-input type="email" placeholder="Email" v-model="user.email" name="email"
                              autofocus></el-input>
                </el-form-item>


                <el-form-item label="Password" prop="password">
                    <el-input :type="passwordType" placeholder="Password" v-model="user.password"
                              name="password">

                        <el-button slot="append" icon="el-icon-view" @click="togglePasswordView"></el-button>
                    </el-input>
                </el-form-item>

                <!-- TODO Social login -->
                <!--@include('auth.social_login')-->

                <p style="margin-bottom:20px;">
                    By Registering, you agree that you've read and accepted our <a :href="userAgreementSrc" target="_blank" style="font-weight: bold;">User Agreement</a>, you're at least 18 years
                    old, and you consent to our <a href="/page/cookies-and-privacy" target="_blank" style="font-weight: bold;">Privacy Notice</a> and receiving marketing communications from us.
                </p>

                <el-form-item>
                    <el-button type="primary" native-type="submit" :loading="loading">Register</el-button>

                    <el-button type="text">
                        <a href="/login">
                            or Login
                        </a>
                    </el-button>

                </el-form-item>

            </el-form>

        </el-card>

    </el-main>
</template>

<script>

    import Errors from '../partials/Errors.vue'

    export default {

        props: {
            userType: '',
            userPlan: ''
        },
        components: {Errors},

        data() {
            return {
                user: {
                    user_plan: 'trial',
                    user_type: 'user',
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: ''
                },
                passwordType: 'password',
                loading: false,
                rules: {
                    first_name: [
                        {required: true, message: 'Required'},
                    ],
                    last_name: [
                        {required: true, message: 'Required'}
                    ],
                    email: [
                        {type: 'email', required: true, message: 'Please enter email'}
                    ],
                    password: [
                        {required: true, message: 'Please enter password'}
                    ],
                    // user_type: [
                    //     {required: true, message: 'Please select customer type'}
                    // ]
                },
                csrf: ''

            }
        },

        mounted() {
            this.csrf = window.csrf;

            if(this.userType && (this.userType == 'artist' || this.userType == 'gallery')) {
                this.user.user_type = this.userType;
            }

            console.log(this.user.user_type, 'usertype');
        },

        methods: {
            register() {
                this.$refs['user'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        this.$refs['user'].$el.submit()
                    }
                });
            },
            togglePasswordView() {
                this.passwordType = this.passwordType === 'password' ? 'text' : 'password'
            }
        },
        computed: {
            userAgreementSrc() {
                return '/page/' +  this.user.user_type + '-agreement';
            }
        }
    }
</script>
