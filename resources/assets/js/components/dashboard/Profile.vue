<template>

    <el-card v-if="user">

        <h2>Personal Information</h2>

        <el-form label-position="top" :model="user" :rules="rules" ref="profile">

            <el-form-item label="Upload avatar">
                <el-upload
                        class="avatar-uploader"
                        :action="'/api/upload/user-avatar/' + user.id"
                        :show-file-list="false"
                        accept=".jpg, .jpeg, .png"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload">
                    <div class="avatar" v-if="user.avatar">
                        <img :src="user.avatar.url" class="avatar">

                        <!--<el-button type="info" plain>-->
                        <!--<i class="el-icon-upload"></i>-->
                        <!--Change Avatar-->
                        <!--</el-button>-->
                    </div>
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>

            <el-form-item label="Upload profile image">
                <el-upload
                        class="avatar-uploader"
                        :action="'/api/upload/user-image/' + user.id"
                        :show-file-list="false"
                        accept=".jpg, .jpeg, .png"
                        :on-success="handleImageSuccess"
                        :before-upload="beforeAvatarUpload">
                    <div v-if="user.image">
                        <img :src="user.image.url" class="image">

                        <!--<el-button type="info" plain>-->
                        <!--<i class="el-icon-upload"></i>-->
                        <!--Change image-->
                        <!--</el-button>-->
                    </div>
                    <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                </el-upload>
            </el-form-item>

            <el-dialog :visible.sync="dialogVisible">
                <img width="100%" :src="dialogImageUrl" alt="">
            </el-dialog>

            <el-row :gutter="20">
                <el-col :sm="12">
                    <el-form-item label="First name" prop="first_name">
                        <el-input v-model="user.first_name"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="Last name" prop="last_name">
                        <el-input v-model="user.last_name"></el-input>
                    </el-form-item>
                </el-col>


                <el-col :sm="12">
                    <el-form-item label="Username ( Name that will be shown on your profile )" prop="user_name">
                        <el-input v-model="user.user_name"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Email" prop="email">
                        <el-input v-model="user.email" disabled></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Country" prop="country_id">
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
                </el-col>


                <el-col :sm="12">
                    <el-form-item label="City" prop="city">
                        <el-input v-model="user.city"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Gender" prop="gender">
                        <el-select value="user.gender" v-model="user.gender">
                            <el-option value="male">Male</el-option>
                            <el-option value="female">Femail</el-option>
                            <el-option value="third_gender">Third</el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :sm="8">
                    <el-form-item label="Date of birth" prop="dob">
                        <el-date-picker
                                v-model="user.dob"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="Date of birth"
                        >
                        </el-date-picker>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Website" prop="website">
                        <el-input placeholder="Website" v-model="user.website"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Phone" prop="phone">
                        <el-input v-model="user.phone"></el-input>
                    </el-form-item>
                </el-col>

                <el-col>
                    <el-form-item label="Address" prop="address">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Address"
                                v-model="user.address">
                        </el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Education" prop="education">
                        <el-input v-model="user.education"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="University educational title" prop="education_title">
                        <el-input v-model="user.education_title"></el-input>
                    </el-form-item>
                </el-col>

                <el-col>
                    <el-form-item label="Technique" prop="technique">
                        <el-select value="" v-model="user.technique" multiple filterable allow-create
                                   default-first-option placeholder="What do you work with?">
                            <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                       :value="medium.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Inspiration" prop="inspiration">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Things that inspire you"
                                v-model="user.inspiration">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="Exhibitions" prop="exhibition">
                        <el-input type="textarea" :rows="2" v-model="user.exhibition"></el-input>
                    </el-form-item>
                </el-col>

            </el-row>


            <el-button type="primary" style="margin-top: 20px"
                       size="big"
                       @click="save()">
                Save
            </el-button>

        </el-form>


    </el-card>

</template>

<script>

    export default {

        props: {
            user_: {},
            countries_: {}
        },

        data() {
            return {

                user: {
                    technique: [],
                },
                rules: {
                    first_name: [
                        {required: true}
                    ],
                    last_name: [
                        {required: true, message: 'Please enter last name', trigger: 'blur'}
                    ],
                },
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

            if (this.countries_) {
                this.countries = this.countries_;
            }

            if (!this.user_.technique) {
                this.user.technique = [];
            }
        },

        methods: {
            handleAvatarSuccess(res, file) {
                this.user.avatar = res;
            },
            handleImageSuccess(res, file) {
                this.user.image = res;
            },
            beforeAvatarUpload(file) {
                const isJPG = file.type === 'image/jpeg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Avatar picture must be JPG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Avatar picture size can not exceed 2MB!');
                }
                return isJPG && isLt2M;
            },

            save() {
                axios.post('/api/profile/', this.user)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: response.data.status
                            });

                            // window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            },

            handleRemove(file, fileList) {
                this.user.photo = [];
            },

            handlePictureCardPreview($url) {
                // this.setDialogUrl();
                this.dialogImageUrl = $url;

                this.dialogVisible = true;
            },

            setDialogUrl() {
                this.dialogImageUrl = '/user/' + this.user.id + '/' + this.user.photo[0].name;
            },
        }
    }
</script>

<style>

    .avatar-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .avatar-uploader .el-upload:hover {
        border-color: #409EFF;
    }

    .avatar-uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 178px;
        height: 178px;
        line-height: 178px;
        text-align: center;
    }

    .avatar {
        max-width: 178px;
        max-height: 178px;
        display: block;
    }

    .image {
        width: 100%;
        display: block;
    }

</style>