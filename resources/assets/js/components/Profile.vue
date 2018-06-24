<template>

    <div v-if="user">

        <h2>Profile settings</h2>


        <el-collapse value="1" accordion>
            <el-collapse-item title="Personal Information" name="1">

                <el-form>
                    <el-form-item label="Name that will be shown on your profile">
                        <el-input v-model="user.user_name"></el-input>
                    </el-form-item>
                </el-form>

                <el-form :inline="true">
                    <el-form-item label="First name">
                        <el-input v-model="user.first_name"></el-input>
                    </el-form-item>
                    <el-form-item label="Last name">
                        <el-input v-model="user.last_name"></el-input>
                    </el-form-item>
                </el-form>

                <el-form :inline="true">

                    <el-form-item label="Gender">
                        <el-select value="user.gender" v-model="user.gender">
                            <el-option value="male">Male</el-option>
                            <el-option value="female">Femail</el-option>
                            <el-option value="third_gender">Third</el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="Date of birth">
                        <el-date-picker
                                v-model="user.dob"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="Date of birth"
                        >
                        </el-date-picker>
                    </el-form-item>
                </el-form>

                <el-form :inline="true">
                    <el-form-item label="Email">
                        <el-input v-model="user.email"></el-input>
                    </el-form-item>

                    <el-form-item label="Country">
                        <el-select filterable value="user.country_id" v-model="user.country_id"
                                   placeholder="Select country">
                            <el-option
                                    v-for="country in countries"
                                    :key="country.id"
                                    :label="country.country_name"
                                    :value="country.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-form>

                <el-form :inline="true">
                    <el-form-item label="Phone">
                        <el-input v-model="user.phone"></el-input>
                    </el-form-item>

                    <el-form-item label="Mobile">
                        <el-input v-model="user.mobile"></el-input>
                    </el-form-item>
                </el-form>

                <el-form :inline="true">


                    <el-form-item label="Website">
                        <el-input placeholder="Website" v-model="user.website">
                            <template slot="prepend">Http://</template>
                        </el-input>
                    </el-form-item>

                    <el-form-item label="Address">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Address"
                                v-model="user.address">
                        </el-input>
                    </el-form-item>

                </el-form>


                <el-form :inline="true">
                    <el-form-item label="Education">
                        <el-input v-model="user.education"></el-input>
                    </el-form-item>

                    <el-form-item label="University educational title">
                        <el-input v-model="user.education_title"></el-input>
                    </el-form-item>
                </el-form>


                <el-form :inline="true">
                    <el-form-item label="Exhibitions">
                        <el-input v-model="user.exhibition"></el-input>
                    </el-form-item>

                    <el-form-item label="Inspiration">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Inspiration"
                                v-model="user.inspiration">
                        </el-input>
                    </el-form-item>

                    <el-form-item label="Technique">
                        <el-input v-model="user.technique"></el-input>
                    </el-form-item>
                </el-form>

                <el-upload
                        :action="'/api/upload/user-photo/' + user.id"
                        list-type="picture-card"
                        :limit="1"
                        :file-list="userPhoto"
                        :on-preview="handlePictureCardPreview"
                        :on-remove="handleRemove"
                        :on-error="handleError"
                        :on-success="handleSuccess"
                        :on-exceed="handleExceed"
                        accept=".jpg, .jpeg, .png">
                    <i class="el-icon-plus"></i>
                    <div slot="tip" class="el-upload__tip">jpg/png files accepted</div>

                </el-upload>

                <el-dialog :visible.sync="dialogVisible">
                    <img width="100%" :src="dialogImageUrl" alt="">
                </el-dialog>

                <el-button type="primary" style="margin-top: 20px"
                           size="big"
                           @click="save()">
                    Save
                </el-button>

            </el-collapse-item>
            <el-collapse-item title="Payment Information" name="2">

            </el-collapse-item>
            <el-collapse-item title="Change Password" name="2">

            </el-collapse-item>

        </el-collapse>

    </div>

</template>

<script>

    export default {

        props: {
            user_: {},
            trans_: {},
            countries_: {}
        },

        data() {
            return {
                user: [],
                trans: [],
                countries: [],

                userPhoto: [],
                dialogImageUrl: '',
                dialogVisible: false
            }
        },


        mounted() {
            if (this.user_) {
                this.user = this.user_;
            }
            if (this.trans_) {
                this.trans = this.trans_;
            }
            if (this.countries_) {
                this.countries = this.countries_;
            }

            if (this.user.photo) {
                this.userPhoto.push({
                    name: this.user.photo,
                    url: '/avatars/' + this.user.id + '/' + this.user.photo
                })
            }
        },

        methods: {

            save() {

                axios.post('/api/profile/', this.user)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            },
            handleExceed(files, fileList) {
                this.$message.warning(`The limit is 1, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
            },
            handleRemove(file, fileList) {
                console.log('remove');
                console.log(file, fileList);
                this.user.photo = '';
            },
            handlePictureCardPreview(file) {
                console.log('preview');
                console.log(file);
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            handleError(er) {
                console.log('error');
                console.log(er);

            },
            handleSuccess(response, file) {
                console.log('success');
                this.user.photo = file.name;
                this.dialogImageUrl = file.url;
            }
        }
    }
</script>