<template>


    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header">Reset Password</div>

            <el-form :model="user" :rules="rules" ref="password" method="post" action="/password/reset"
                     @submit.native.prevent="submitForm">

                <input type="hidden" name="_token" :value="csrf">
                <input type="hidden" name="token" :value="token_">

                <errors></errors>

                <el-form-item label="E-Mail Address" prop="email">
                    <el-input placeholder="Email" v-model="user.email" name="email" autofocus></el-input>
                </el-form-item>

                <el-form-item label="New Password" prop="password">
                    <el-input type="password" placeholder="New Password" v-model="user.password"
                              name="password"></el-input>
                </el-form-item>

                <el-form-item label="Confirm Password" prop="password_confirmation">
                    <el-input type="password" placeholder="Confirm Password" v-model="user.password_confirmation"
                              name="password_confirmation"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Reset Password</el-button>
                </el-form-item>

            </el-form>

        </el-card>

    </el-main>

</template>

<script>

    import Errors from './../partials/Errors.vue'

    export default {

        props: {'token_': ''},
        components: {Errors},

        data() {
            return {
                user: {
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                rules: {
                    email: [
                        {type: 'email', required: true, message: 'Required'},
                    ],
                    password: [
                        {required: true, message: 'Required'},
                    ],
                    password_confirmation: [
                        {required: true, message: 'Required'},
                        {
                            validator: (rule, value, callback) => {
                                if (value !== this.user.password) {
                                    callback(new Error('Two inputs don\'t match!'));
                                } else {
                                    callback();
                                }
                            }
                        },
                    ]
                },
                csrf: '',
                token: ''

            }
        },

        mounted() {
            this.csrf = window.csrf;
        },

        methods: {
            submitForm() {

                this.$refs['password'].validate((valid) => {
                    console.log(valid);
                    if (valid) {
                        this.$refs['password'].$el.submit()
                    }
                });
            }
        }
    }
</script>
