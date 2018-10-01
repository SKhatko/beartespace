<template>

    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Sign in</div>

            <slot></slot>

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
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" native-type="submit" :loading="loading">Sign in</el-button>

                    <signup-dialog type_="button"></signup-dialog>

                </el-form-item>

                <el-button type="text"><a href="/password/reset">Forgot Your Password?</a></el-button>


            </el-form>

            <div class="h4" style="margin: 20px 0; text-align: center;">Log in via</div>

            <el-button plain>
                <a href="/login/facebook">
                    <span class="hidden-xs"><i class="fa fa-facebook-square"></i> Facebook</span>
                </a>
            </el-button>


            <el-button plain>
                <a href="/login/google">
                    <span class="hidden-xs"><i class="fa fa-google-plus-square"></i> Google</span>
                </a>
            </el-button>

            <el-button plain>
                <a href="/login/twitter" class="btn btn-lg btn-block btn-twitter">
                    <span class="hidden-xs"><i class="fa fa-twitter"></i> Twitter</span>
                </a>
            </el-button>

        </el-card>

    </el-main>

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