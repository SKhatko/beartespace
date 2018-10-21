<template>

    <div>
        <el-button plain @click="usernameDialog = true" style="margin-top: 20px;">Start to Sell</el-button>

        <el-dialog :visible.sync="usernameDialog" title="Your public username">
            <el-form label-position="top" :model="user" status-icon :rules="rules" ref="username" action="/"
                     @submit.native.prevent="checkUsername">
                <el-form-item label="Enter your public username ( Personal profile url link )" prop="user_name">
                    <el-input v-model="user.user_name" style="max-width: 290px; margin-right: 20px;"></el-input>

                    <el-button native-type="submit">Check</el-button>
                </el-form-item>

                <p>Your profile url will look like</p>
                <p><b>{{ userName }}</b></p>

            </el-form>

            <div slot="footer" class="dialog-footer">
                <el-button @click="usernameDialog = false">Skip for now</el-button>
                <el-button type="primary" @click="checkUsername">Confirm</el-button>
            </div>
        </el-dialog>

    </div>

</template>

<script>
    export default {
        props: {
            user_: {},
        },
        data() {

            let userNameValidator = (rule, value, callback) => {
                if (!value) {
                    callback(new Error('Username cannot be empty'));
                } else {
                    axios.get('/api/user/check-username/' + value)
                        .then(response => {
                            console.log(response.data);
                            if (response.data) {
                                this.user.user_name = response.data;
                                callback();
                            } else {
                                callback(new Error('This username is already taken'));
                            }
                        })
                        .catch(error => {
                            console.log(error.response);
                            callback()
                        });
                }
            };

            return {
                csrf: '',
                usernameDialog: false,
                user: {
                    user_name: '',
                },
                rules: {
                    user_name: [
                        {validator: userNameValidator}
                    ],
                },
            }
        },
        mounted() {
            this.csrf = window.csrf;

            if (this.user_) {
                this.user = JSON.parse(this.user_);
            }

            console.log(this.user);
        },
        computed: {
            userName() {
                return window.location.origin + '/' + (this.user.user_name ? this.user.user_name : 'artist/' + this.user.id);
            },
        },
        methods: {
            checkUsername() {
                this.$refs['username'].validate((valid) => {
                    if (valid) {
                        console.log('not valid username');
                        // this.loading = true;
                        // console.log(this.user);
                        // axios.post('/api/profile/', this.user)
                        //     .then((response) => {
                        //         console.log(response.data);
                        //         window.location = '/dashboard';
                        //     }).catch(error => {
                        //     this.loading = false;
                        //     console.log(error.response);
                        // });
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>