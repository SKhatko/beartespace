<template>
    <el-main class="app-auth">

        <el-card class="box-card app-auth-register">
            <div slot="header" class="clearfix">New User Registration</div>

            <el-form label-position="top" :rules="rules" :model="user" ref="user" method="post" action="/register"
                     @submit.native.prevent="register">

                <errors></errors>

                <input type="hidden" name="_token" :value="csrf">


                <el-row :gutter="20">
                    <el-col>

                        <el-form-item label="Select user type">

                            <el-radio-group v-model="user.user_type" name="user_type">
                                <el-radio-button name="user_type" label="user">Customer</el-radio-button>
                                <el-radio-button name="user_type" label="artist">Artist</el-radio-button>
                                <el-radio-button name="user_type" label="gallery">Gallery</el-radio-button>
                            </el-radio-group>

                        </el-form-item>
                    </el-col>
                </el-row>

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
                    <el-input type="password" placeholder="Password" v-model="user.password"
                              name="password"></el-input>
                </el-form-item>

                <!-- TODO Social login -->
                <!--@include('auth.social_login')-->

                <div style="margin-bottom:20px;">
                    By Registering, you agree that you've read and accepted our User Agreement, you're at least 18 years
                    old, and you consent to our Privacy Notice and receiving marketing communications from us.
                </div>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Register</el-button>

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

        props: {},
        components: {Errors},

        data() {
            return {
                user: {
                    user_type: 'user',
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: ''
                },
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
                    user_type: [
                        {required: true, message: 'Please select customer type'}
                    ]
                },
                csrf: ''

            }
        },

        mounted() {
            this.csrf = window.csrf;
        },

        methods: {
            register() {

                console.log(this.user);

                this.$refs['user'].validate((valid) => {
                    if (valid) {
                        this.$refs['user'].$el.submit()
                    }
                });
            }
        }
    }
</script>
