<template>
    <el-main class="app-auth">

        <el-card class="box-card app-auth-login">
            <div slot="header" class="clearfix">Login</div>

            <el-form :model="user" :rules="rules" ref="user" >

                <el-form-item label="E-Mail Address" prop="email">
                    <el-input type="email" placeholder="Email" v-model="user.email" name="email" autofocus required></el-input>
                </el-form-item>

                <el-form-item label="Password" prop="password">
                    <el-input type="password" placeholder="Password" v-model="user.password" name="password" required></el-input>
                </el-form-item>

                <el-form-item>
                    <el-checkbox v-model="user.remember_me">Remember Me</el-checkbox>
                </el-form-item>

                <el-form-item>
                    <el-button type="primary" @click="login">Login</el-button>

                    <el-button type="text"><a href="/password/reset">Forgot Your Password?</a></el-button>

                </el-form-item>


            </el-form>

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
                    remember_me: true
                },
                rules: {
                    email: [
                        {type: 'email', required: true, message: 'Please enter email'}
                    ],
                    password: [
                        {required: true, message: 'Please enter password'}
                    ],
                }

            }
        },

        methods: {
            login() {

                console.log(this.user);

                this.$refs['user'].validate((valid) => {
                    console.log(valid);

                    if (valid) {
                        axios.post('/api/login/', this.user)
                            .then((response) => {
                                if (response.data) {
                                    console.log(response.data);
                                    this.$message({
                                        showClose: true,
                                        message: response.data.message,
                                        type: response.data.status
                                    });

                                    this.pages = response.data.data;
                                    // window.location.reload();
                                    // window.location.href = '/dashboard';
                                } else {
                                    console.log(response.data);
                                }
                            });
                    }
                });
            }
        }
    }

</script>