<template>

    <el-card>

        <el-form label-position="top" :model="user" status-icon :rules="rules" ref="username" action="/sell/profile-name" method="POST"
                 @submit.native.prevent="submitForm">

            <slot></slot>


            <div class="h3">Personal profile url link</div>


            <el-form-item label="Enter your public username" prop="user_name">
                <el-input v-model="user.user_name" name="user_name"
                          style="max-width: 290px; margin-right: 20px;margin-bottom:10px"></el-input>
            </el-form-item>


            <el-button @click="checkUserName()" :loading="usernameLoading">
                Check
            </el-button>

            <div class="small" v-text="userProfileLink" style="margin-top: 10px;"></div>

            <div class="app-sell-profile-name-bottom">
                <div class="app--wrapper">
                    <el-button type="primary" native-type="submit" :loading="loading">Save and Continue</el-button>
                </div>
            </div>

        </el-form>
    </el-card>


</template>

<script>
    export default {
        props: {
            user_: {},
        },
        data() {

            let userNameValidator = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error("Name can't be empty"));
                    this.setUserProfileLink();
                } else {
                    console.log(value);
                    axios.post('/api/user/check-username', {'username': value})
                        .then(response => {
                            if (!response.data) {
                                callback(new Error('This username is already taken'));
                            }

                            this.user.user_name = response.data;
                            this.setUserProfileLink();
                            callback();
                        })
                        .catch(error => {
                            console.log(error);
                            callback('Server error')
                        });
                }
            };

            return {
                csrf: '',
                loading: false,
                usernameLoading: false,
                userProfileLink: '',
                user: {},
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
            setUserProfileLink() {
                this.userProfileLink = window.location.origin + '/' + (this.user.user_name ? this.user.user_name : 'artist/' + this.user.id);
            },

            submitForm() {
                this.$refs['username'].validate((valid) => {
                    if(valid) {
                        this.loading = true;
                        this.$refs['username'].$el.submit();
                    }
                });
            },

            checkUserName() {
                this.usernameLoading = true;
                this.$refs['username'].validate((valid) => {
                    this.usernameLoading = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>