<template>

    <el-main class="app-auth">

        <el-card class="box-card app-auth-reset">
            <div slot="header">Reset Password</div>


            <el-form :model="user" :rules="rules" ref="email" method="post" action="/password/email"
                     @submit.native.prevent="submitForm">

                <input type="hidden" name="_token" :value="csrf">

                <errors></errors>

                <el-form-item label="E-Mail Address" prop="email">
                    <el-input placeholder="Email" v-model="user.email" name="email" autofocus></el-input>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Send Restore Link</el-button>
                    <el-button type="text"><a href="/register">Create New Account</a></el-button>
                </el-form-item>

            </el-form>

        </el-card>

    </el-main>

</template>

<script>

    import Errors from './partials/Errors.vue'

    export default {

        props: {},
        components: {Errors},

        data() {
            return {
                user: {email: ''},
                rules: {
                    email: [
                        {type: 'email', required: true, message: 'Required'},
                    ],
                },
                csrf: ''

            }
        },

        mounted() {
            this.csrf = window.csrf;
        },

        methods: {
            submitForm() {

                console.log(this.user.email);

                this.$refs['email'].validate((valid) => {
                    if (valid) {
                        this.$refs['email'].$el.submit()
                    }
                });
            }
        }
    }
</script>
