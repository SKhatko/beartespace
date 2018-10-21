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