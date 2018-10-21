<template>

    <el-form label-position="top" :rules="rules" :model="user" ref="user" method="post" action="/register"
             @submit.native.prevent="register">

        <input type="hidden" name="_token" :value="csrf">

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

        <el-form-item>
            <el-button type="primary" native-type="submit" :loading="loading" style="width: 100%">Register</el-button>
        </el-form-item>

    </el-form>

</template>

<script>

    export default {

        props: {
            userType_: '',
            userPlan: '',
        },

        data() {
            return {
                user: {
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
                },
                csrf: ''

            }
        },

        mounted() {
            this.csrf = window.csrf;

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
        computed: {}
    }
</script>
