<template>

    <el-card class="app-sell-profile-name-form" v-if="user">


        <el-form label-position="top" :model="user" status-icon :rules="rules" ref="username" action="/sell/profile-name"
                 method="POST" @submit.native.prevent="submitForm">

            <input type="hidden" name="user_type" :value="user.user_type">

            <slot></slot>

            <div class="h3">Personal profile url link</div>

            <el-form-item label="Enter your public profile name" prop="user_name">
                <el-input v-model="user.user_name" name="user_name">
                    <el-button slot="append" @click="checkUserName" :loading="usernameLoading">Check</el-button>
                </el-input>
            </el-form-item>

            <div style="margin-bottom: 20px;">Your profile name will appear in url of your personal page and your
                artworks. You'll not be able to change your profile name after validation your profile
            </div>

            <transition name="el-fade-in">
                <div class="h6" v-html="userProfileLink" style="margin-top: 10px;min-height:18px"></div>
            </transition>

            <div style="text-align: right;margin-top: 20px;">
                <el-button type="primary" native-type="submit" :loading="loading">Save and Continue</el-button>
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
                console.log(value);
                if (value === '') {
                    callback(new Error("Name can't be empty"));
                    this.userProfileLink = '';
                } else if (/\s/.test(value)) {
                    callback(new Error('The name may only include unaccented roman letters, dashes and numbers, without spaces.'));
                    this.userProfileLink = '';
                } else if (value.length < 5) {
                    callback(new Error("Minimal length 8 symbols"));
                    this.userProfileLink = '';
                } else {
                    console.log(value);
                    axios.post('/api/user/check-username', {'username': value})
                        .then(response => {
                            if (!response.data) {
                                callback(new Error('This username is already taken'));
                            } else {
                                this.user.user_name = response.data;
                                this.setUserProfileLink();
                                callback();
                            }
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
                sellerType: '',
                user: {},
                rules: {
                    user_name: [
                        {validator: userNameValidator, trigger: 'submit'}
                    ],
                },
            }
        },
        mounted() {
            this.csrf = window.csrf;

            if (this.user_) {
                this.user = JSON.parse(this.user_)
            }

            console.log(this.user);
        },
        computed: {
            userName() {
                return window.location.origin + '/' + this.user.user_name;
            },
        },
        methods: {
            setUserProfileLink() {
                this.userProfileLink = '<b>Your public url will be:</b> ' + window.location.origin + '/' + this.user.user_name;
            },

            submitForm() {
                this.$refs['username'].validate((valid) => {
                    if (valid) {
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