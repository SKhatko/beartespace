<template>

    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Login</div>

            <errors></errors>

            <el-form :model="user" :rules="rules" ref="user" method="post" action="/login"
                     @submit.native.prevent="login">

                <input type="hidden" name="_token" :value="csrf">

                <el-form-item label="E-Mail Address" prop="email">
                    <el-input type="email" placeholder="Email" v-model="user.email" name="email" autofocus></el-input>
                </el-form-item>

                <el-form-item label="Password" prop="password">
                    <el-input type="password" placeholder="Password" v-model="user.password" name="password"></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Login</el-button>

                    <el-button type="text"><a href="/register">Create New Account</a></el-button>

                </el-form-item>

                <el-button type="text"><a href="/password/reset">Forgot Your Password?</a></el-button>


            </el-form>

            <!--<a href="/login/facebook" class="btn btn-lg btn-block btn-facebook">-->
            <!--<span class="hidden-xs"><i class="fa fa-facebook-square"></i> Facebook</span>-->
            <!--</a>-->

            <!--<a href="/login/google" class="btn btn-lg btn-block btn-google">-->
            <!--<span class="hidden-xs"><i class="fa fa-google-plus-square"></i> Google</span>-->
            <!--</a>-->

            <!--<a href="/login/twitter" class="btn btn-lg btn-block btn-twitter">-->
            <!--<span class="hidden-xs"><i class="fa fa-twitter"></i> Twitter</span>-->
            <!--</a>-->

        </el-card>

    </el-main>

</template>

<script>

    import Errors from '../partials/Errors.vue'

    export default {

        components: {Errors},

        props: {},

        data() {
            return {
                user: {
                    email: '',
                    password: '',
                },
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

                console.log(this.user);

                this.$refs['user'].validate((valid) => {
                    if (valid) {
                        this.$refs['user'].$el.submit();
                    }
                });
            }
        }
    }

</script>