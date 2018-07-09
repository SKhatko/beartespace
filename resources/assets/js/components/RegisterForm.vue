<template>
    <el-main class="app-auth">

        <el-card class="box-card app-auth-register">
            <div slot="header" class="clearfix">New User Registration</div>

            <el-form label-position="top">

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
                        <el-form-item label="First Name" required>
                            <el-input name="first_name" v-model="user.first_name" autofocus></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="Last Name" required>
                            <el-input name="last_name" v-model="user.last_name""></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-form-item label="E-Mail Address" required>
                    <el-input type="email" placeholder="Email" v-model="user.email" name="email"
                              autofocus></el-input>
                </el-form-item>

                <el-form-item label="Password" required>
                    <el-input type="password" placeholder="Password" v-model="user.password"
                              name="password"></el-input>
                </el-form-item>


                <!-- TODO Social login -->
                 <!--@include('auth.social_login')-->


                <!--NoCaptcha::display()-->


                <div style="margin-bottom:20px;">
                    By Registering, you agree that you've read and accepted our User Agreement, you're at least 18 years old, and you consent to our Privacy Notice and receiving marketing communications from us.
                </div>

                <el-form-item>
                    <el-button type="primary" native-type="submit">Register</el-button>

                    <el-button type="text">
                        <a href="">
                            or Login
                        </a>
                    </el-button>

                </el-form-item>

            </el-form>

        </el-card>

    </el-main>
</template>

<script>

    export default {

        props: {

        },

        data() {
            return {
                user: {
                    user_type: 'user'
                },
            }
        },

        mounted() {


        },

        methods: {


            save(page) {
                axios.post('/api/pages/', page)
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
        }
    }
</script>
