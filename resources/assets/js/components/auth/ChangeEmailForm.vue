<template>

    <span>
        <el-button type="text" @click="showChangeEmailForm = true">change <i class="el-icon-edit-outline"></i></el-button>

        <el-dialog
                title="Change Email"
                :visible.sync="showChangeEmailForm"
                width="290px">
            <el-form :model="newEmail" :rules="newEmailRules" ref="newEmail">

                <errors></errors>

                <el-form-item label="Enter new E-Mail Address" prop="email">
                    <el-input type="email" placeholder="Email" v-model="newEmail.email" name="email"
                              autofocus></el-input>
                </el-form-item>

                <el-form-item label="Confirm new E-Mail Address" prop="email_confirmation">
                    <el-input type="email" placeholder="Email" v-model="newEmail.email_confirmation"
                              name="email_confirmation"></el-input>
                </el-form-item>

                <el-form-item label="Password" prop="password">
                    <el-input :type="passwordType" placeholder="Password" v-model="newEmail.password" name="password">
                        <el-button slot="append" icon="el-icon-view" @click="togglePasswordView"></el-button>
                    </el-input>
                </el-form-item>

            </el-form>

            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="changeEmail" :loading="loading">Confirm</el-button>
              </span>

        </el-dialog>
    </span>


</template>

<script>
    export default {
        data() {

            var emailValidator = (rule, value, callback) => {
                if (value === '') {
                    callback(new Error('Please confirm email'));
                } else if (value !== this.newEmail.email) {
                    callback(new Error('Two inputs don\'t match!'));
                } else {
                    callback();
                }
            };

            return {
                loading: false,
                showChangeEmailForm: false,
                newEmail: {
                    email: '',
                    email_confirmation: '',
                    password: ''
                },
                passwordType: 'password',
                newEmailRules: {
                    email: [
                        {type: 'email', required: true, message: 'Please enter email', trigger: 'blur'}
                    ],
                    email_confirmation: [
                        {required: true, validator: emailValidator, trigger: 'blur'}
                    ],

                    password: [
                        {required: true, message: 'Please enter password', trigger: 'blur'}
                    ],
                },
            }
        },
        methods: {

            togglePasswordView() {
                this.passwordType = this.passwordType === 'password' ? 'text' : 'password'
            },

            changeEmail() {
                this.$refs['newEmail'].validate((valid) => {
                    if (valid) {
                        this.loading = true;

                        axios.post('/api/change-email', this.newEmail)
                            .then(response => {
                                console.log(response.data);
                                window.location.reload();
                            })
                            .catch(error => {
                                this.$store.commit('setErrors', error.response.data.errors);
                            })
                        // this.$refs['user'].$el.submit();
                    }
                });

            },
        }

    }
</script>

<style scoped>

</style>