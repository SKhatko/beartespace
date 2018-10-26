<template>

    <el-form :model="user" :rules="rules" ref="user" method="post" action="/login"
             @submit.native.prevent="login">

        <input type="hidden" name="_token" :value="csrf">

        <el-form-item label="E-Mail Address" prop="email">
            <el-input type="email" placeholder="Email" v-model="user.email" name="email" autofocus></el-input>
        </el-form-item>

        <el-form-item label="Password" prop="password">
            <el-input :type="passwordType" placeholder="Password" v-model="user.password" name="password">
                <el-button slot="append" icon="el-icon-view" @click="togglePasswordView"></el-button>
            </el-input>
        </el-form-item>

        <el-form-item>
            <el-checkbox name="remember" :checked="user.remember">Remember Me</el-checkbox>

            <a href="/password/reset" style="float: right;text-decoration: underline;">Forgot Your Password?</a>
        </el-form-item>

        <el-form-item>
            <el-button type="primary" native-type="submit" :loading="loading" style="width:100%">
                Sign in
            </el-button>
        </el-form-item>

        <div class="h5" style="margin: 20px 0; text-align: center;">or continue with</div>

        <a href="/login/facebook" class="el-button el-button--default is-plain" style="display: block;">
            <i class="icon-facebook"></i> Facebook
        </a>

        <a href="/login/google" class="el-button el-button--default is-plain"
           style="display: block;margin: 15px 0;">
            <i class="icon-googleplus"></i> Google
        </a>

        <!--<a href="/login/twitter" class="el-button el-button&#45;&#45;default is-plain" style="display: block;margin: 0;">-->
        <!--Continue with Twitter-->
        <!--</a>-->

        <p class="small">
            By Signing up, you agree that you've read and accepted our <a href="/pages/user-agreement"
                                                                          target="_blank"
                                                                          style="font-weight: bold;">User
            Agreement</a>, you're at least 18 years
            old, and you consent to our <a href="/page/cookies-and-privacy" target="_blank"
                                           style="font-weight: bold;">Privacy Notice</a> and receiving marketing
            communications from us.
        </p>

    </el-form>

</template>

<script>

    export default {

        props: {},

        data() {
            return {
                user: {
                    email: '',
                    password: '',
                    remember: true
                },
                passwordType: 'password',
                loading: false,
                rules: {
                    email: [
                        {type: 'email', required: true, message: 'Please enter email', trigger: 'blur'}
                    ],
                    password: [
                        {required: true, message: 'Please enter password', trigger: 'blur'}
                    ],
                },
                csrf: ''

            }
        },
        mounted() {
            this.csrf = window.csrf;
        },

        methods: {
            login() {
                this.$refs['user'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        this.$refs['user'].$el.submit();
                    }
                });
            },
            togglePasswordView() {
                this.passwordType = this.passwordType === 'password' ? 'text' : 'password'
            }
        }
    }

</script>