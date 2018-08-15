<template>

    <el-card v-if="user">

        <div v-if="user.user_type === 'user'">User</div>
        <div v-if="user.user_type === 'artist'">Artist</div>
        <div v-if="user.user_type === 'gallery'">Gallery</div>
        <div v-if="user.user_type === 'admin'">Admin</div>

        <h2>Profile information</h2>

        <el-form label-position="top">

            <el-form-item :label="user.user_type === 'gallery' ? 'Upload logo' : 'Upload avatar'">

                <el-upload
                        class="avatar-uploader"
                        action="/api/upload/user-avatar"
                        :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                        :show-file-list="false"
                        accept="image/*"
                        :on-success="handleAvatarSuccess"
                        :before-upload="beforeAvatarUpload">
                    <img :src="'/imagecache/avatar/' + user.avatar_url" class="avatar">
                </el-upload>

                <div class="profile-avatar-cropper" style="display: none;">
                    <cropper v-model="avatarCropper"
                             placeholder="Click to upload"
                             canvas-color="#ffffff"
                             :quality="1"
                             :width="290"
                             :height="290"
                             @new-image="avatarChanged = true"
                             @image-remove="avatarChanged = true"
                             @move="avatarChanged = true"
                             @zoom="avatarChanged = true"
                             prevent-white-space
                             remove-button-color="#379797">

                        <img v-if="user.avatar" crossOrigin="anonymous" slot="initial" :src="user.avatar.url"/>
                        <!--<img slot="placeholder" src="/images/user-placeholder-image.png"/>-->
                    </cropper>

                    <el-button @click="uploadAvatar" v-if="avatarChanged" type="primary" plain
                               class="profile-avatar-save" round>
                        Save
                    </el-button>

                </div>

            </el-form-item>

            <el-form-item label="Upload profile background image" v-if="user.user_type === 'artist' || user.user_type === 'gallery'">

                <el-upload
                        class="image-uploader"
                        action="/api/upload/user-image"
                        :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                        :show-file-list="false"
                        accept="image/*"
                        :on-success="handleImageSuccess"
                        :before-upload="beforeImageUpload">
                    <img :src="'/imagecache/avatar/' + user.image_url" class="image">
                </el-upload>

            </el-form-item>

        </el-form>

        <el-form label-position="top" :model="user" status-icon :rules="rules" ref="profile">

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


                <el-col v-if="user.user_type === 'artist'">
                    <el-form-item label="Your public username" prop="user_name">
                        <el-input v-model="user.user_name" style="max-width: 290px; margin-right: 20px;"></el-input>

                        <el-button type="text">
                            <a :href="userName" target="_blank">
                                {{ userName }}
                            </a>
                        </el-button>
                    </el-form-item>
                </el-col>


                <el-col>
                    <el-form-item label="Email" prop="email">
                        <el-input v-model="user.email" disabled style="max-width: 290px;margin-right: 20px;"></el-input>
                        <el-button type="text">Change Email</el-button>
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

                <el-col :sm="8" v-if="user.user_type === 'artist'">
                    <el-form-item label="Nationality" prop="nationality_id">
                        <el-select filterable value="user.nationality_id" v-model="user.nationality_id"
                                   placeholder="Select your nationality">
                            <el-option
                                    v-for="country in countries"
                                    :key="country.id"
                                    :label="country.citizenship"
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

                <el-col :sm="12">
                    <el-form-item label="Postcode" prop="postcode">
                        <el-input v-model="user.postcode"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Address" prop="address">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Address"
                                v-model="user.address">
                        </el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8" v-if="user.user_type === 'artist' ">
                    <el-form-item label="Gender" prop="gender">
                        <el-select value="user.gender" v-model="user.gender">
                            <el-option value="male">Male</el-option>
                            <el-option value="female">Femail</el-option>
                            <el-option value="third_gender">Third</el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="8" v-if="user.user_type === 'artist'">
                    <el-form-item label="Date of birth" prop="dob">
                        <el-date-picker
                                v-model="user.dob"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="yyyy-mm-dd">
                        </el-date-picker>
                    </el-form-item>
                </el-col>

                <el-col :sm="8" v-if="user.user_type === 'artist' || user.user_type === 'gallery' ">
                    <el-form-item label="Phone" prop="phone">
                        <el-input v-model="user.phone"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12" v-if="user.user_type === 'artist' ">
                    <el-form-item label="Name of the high school " prop="education">
                        <el-input v-model="user.education"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12" v-if="user.user_type === 'artist' ">
                    <el-form-item label="University educational title" prop="education_title">
                        <el-input v-model="user.education_title"></el-input>
                    </el-form-item>
                </el-col>

                <el-col v-if="user.user_type === 'artist' ">
                    <el-form-item label="Technique" prop="technique">
                        <el-select value="" v-model="user.technique" multiple filterable allow-create
                                   default-first-option placeholder="What do you work with?">
                            <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                       :value="medium.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="12" v-if="user.user_type === 'artist'">
                    <el-form-item label="Inspiration" prop="inspiration">
                        <vue-editor id="inspiration" v-model="user.inspiration"
                                    :editorToolbar="profileEditorToolbar"></vue-editor>
                    </el-form-item>
                </el-col>


                <el-col :sm="12" v-if="user.user_type === 'artist' || user.user_type === 'gallery' ">
                    <el-form-item label="Exhibitions" prop="exhibition">
                        <vue-editor id="exhibition" v-model="user.exhibition"
                                    :editorToolbar="profileEditorToolbar"></vue-editor>
                    </el-form-item>
                </el-col>

            </el-row>

            <div v-if="user.user_type === 'artist'" style="display: none;">

                <el-form-item label="Upload profile image">
                    <div class="profile-image-cropper">
                        <cropper v-model="imageCropper"
                                 placeholder="Click to upload"
                                 canvas-color="#ffffff"
                                 :quality="1"
                                 @new-image="imageChanged = true"
                                 @image-remove="imageChanged = true"
                                 @move="imageChanged = true"
                                 @zoom="imageChanged = true"
                                 prevent-white-space
                                 remove-button-color="gray">

                            <img v-if="user.image" crossOrigin="anonymous" slot="initial" :src="user.image.url"/>
                        </cropper>

                        <el-button @click="uploadImage" v-if="imageChanged" type="primary" class="profile-image-save"
                                   round>Save image
                        </el-button>

                    </div>
                </el-form-item>

            </div>

            <el-button type="primary" style="margin-top: 20px"
                       size="big"
                       @click="save()" :loading="saving">
                Save
            </el-button>

            <el-button style="margin-top: 20px" v-if="user.user_type === 'artist'">
                <a :href="'/artist/' + user.id" target="_blank">Preview</a>
            </el-button>

            <el-button style="margin-top: 20px" v-if="user.user_type === 'user' && profileSaved" type="text">
                <a href="/artwork">Show Artworks</a>
            </el-button>

            <el-button v-if="user.user_type === 'artist'" type="success">
                <a href="/dashboard/artwork/create">Upload
                    Artwork</a>
            </el-button>

        </el-form>

    </el-card>

</template>

<script>
    import {VueEditor} from 'vue2-editor'

    export default {

        props: {
            user_: {},
            countries_: {}
        },

        data() {
            let userNameValidator = (rule, value, callback) => {

                if (value === '') {
                    callback(new Error('Please input the password again'));
                } else if (value !== 'test') {
                    callback(new Error('Two inputs don\'t match!'));
                } else {
                    callback();
                }
            };
            return {
                saving: false,

                avatarCropper: {},
                avatarChanged: false,
                imageCropper: {},
                imageChanged: false,
                user: {
                    technique: [],
                },
                profileSaved: false,
                rules: {
                    first_name: [
                        {required: true, message: 'Please enter first name', trigger: 'blur'}
                    ],
                    last_name: [
                        {required: true, message: 'Please enter last name', trigger: 'blur'}
                    ],
                    user_name: [
                        // {validator: userNameValidator, trigger: ['blur', 'change']}
                        // {required: true, message: 'user name is required'}
                    ],
                },
                csrf: '',
                countries: [],
                profileEditorToolbar: [
                    [{'size': ['small', false, 'large', 'huge']}],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                    ['blockquote'],
                    [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                ]
            }
        },

        mounted() {
            this.csrf = window.csrf;

            if (this.user_) {
                this.user = JSON.parse(this.user_);
            }

            console.log(this.user);

            if (this.countries_) {
                this.countries = JSON.parse(this.countries_);
            }

            if (!this.user_.technique) {
                this.user.technique = [];
            }

        },

        methods: {

            handleAvatarSuccess(response, file) {
                console.log(response);
                this.user.avatar_url = response.data;
                this.$message({
                    showClose: true,
                    message: response.message,
                    type: response.status
                });
            },

            handleImageSuccess(response, file) {
                console.log(response);
                this.user.image_url = response.data;
                this.$message({
                    showClose: true,
                    message: response.message,
                    type: response.status
                });
            },

            beforeAvatarUpload(file) {
                console.log(file);
                const isJPG = file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/jpg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Avatar picture must be JPG, JPEG, or PNG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Avatar picture size can not exceed 2MB!');
                }
                return isJPG && isLt2M;
            },

            beforeImageUpload(file) {
                console.log(file);
                const isJPG = file.type === 'image/jpeg' || file.type === 'image/png' || file.type === 'image/jpg';
                const isLt2M = file.size / 1024 / 1024 < 2;

                if (!isJPG) {
                    this.$message.error('Image picture must be JPG, JPEG, or PNG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Image picture size can not exceed 2MB!');
                }
                return isJPG && isLt2M;
            },

            save() {
                this.$refs['profile'].validate((valid) => {
                    if (valid) {
                        this.saving = true;
                        axios.post('/api/profile/', this.user)
                            .then((response) => {
                                if (response.data) {
                                    console.log(response.data);
                                    this.$message({
                                        showClose: true,
                                        message: response.data.message,
                                        type: response.data.status
                                    });
                                    this.profileSaved = true;
                                    this.saving = false;
                                } else {
                                    console.log(response.data);
                                }
                            });
                    }
                });
            },

            uploadAvatar() {

                let avatarSrc = this.avatarCropper.generateDataUrl('image/jpeg');

                axios.post('/api/upload/user-avatar', {avatar: avatarSrc})
                    .then((response) => {
                        console.log(response.data);
                        this.user.avatar = response.data.data;
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: response.data.status
                        });
                    });
            },

            checkUserName($username) {
                if ($username) {
                    axios.get('/api/user/check-username/' + $username).then(response => {
                        console.log(response.data);
                    });
                    console.log($username);
                }

            },

            uploadImage() {

                let imageSrc = this.imageCropper.generateDataUrl('image/jpeg');

                axios.post('/api/upload/user-image', {avatar: imageSrc})
                    .then((response) => {
                        console.log(response.data);
                        this.user.avatar = response.data.data;
                        this.$message({
                            showClose: true,
                            message: response.data.message,
                            type: response.data.status
                        });
                    });
            }
        },
        computed: {
            userName() {
                return window.location.origin + '/' + this.user.user_name ? this.user.user_name : 'artist/' + this.user.id;
            }
        }
    }
</script>

<style lang="scss">

    .profile-avatar-cropper {
        line-height: initial;
        margin-bottom: 10px;
        display: flex;
        align-items: flex-start;
        position: relative;

        .croppa-container {
            border: 1px dashed #379797
        }
    }

    .profile-avatar-save {
        position: absolute;
        bottom: 10px;
        left: 110px;
    }

    .avatar-uploader .el-upload, .image-uploader .el-upload {
        border: 1px dashed #d9d9d9;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        overflow: hidden;

        &:hover {
            border-color: #409EFF;
        }
    }

    .avatar {
        width: 178px;
        height: 178px;
        display: block;
    }
    .image {
        /*width: 178px;*/

        height: 178px;
        display: block;
    }


</style>