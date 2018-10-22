<template>

    <div>
        <el-button plain @click="usernameDialog = true" style="margin-top: 20px;">Start to Sell</el-button>

        <el-dialog :visible.sync="usernameDialog" title="Your public username">


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

        }
    }
</script>

<style scoped>

</style>