<template>

    <el-card v-if="user" class="profile">
        <div slot="header">
            <div class="profile-header">
                <span>Your Public Profile</span>
                <a href="/" class="el-button el-button--default el-button--mini">View profile</a>
            </div>
        </div>

        <!--<div class="h2">-->
            <!--{{ user.name }}-->
            <!--<a href="" class="el-button el-button&#45;&#45;default el-button&#45;&#45;mini">Following</a>-->
            <!--<a href="" class="el-button el-button&#45;&#45;default el-button&#45;&#45;mini">Followers</a>-->
        <!--</div>-->


        <el-form label-position="top">

            <el-row :gutter="20">

                <el-col :sm="12">
                    <el-form-item>
                        <span slot="label">
                            <span>
                                Profile Picture
                            </span>
                              <el-popover
                                      width="200"
                                      trigger="hover">
                                        <span>
                                            This image represents you here on website.
                                            Make sure your image is in good quality and has a nice smile :)
                                        </span>
                                       <i slot="reference" class="el-icon-info"></i>
                               </el-popover>
                        </span>

                        <el-upload
                                class="profile-avatar"
                                action="/api/user/upload-user-avatar"
                                :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                                :show-file-list="false"
                                accept="image/*"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload">
                            <el-button slot="trigger" icon="el-icon-picture"  class="profile-avatar-button" circle></el-button>
                            <div slot="tip" class="el-upload__tip">*Must be a .jpg, .gif or .png file smaller than 10MB and at least 400px by 400px.</div>

                            <img v-if="user.avatar_url" :src="'/imagecache/avatar' + user.avatar_url"
                                 class="avatar">
                        </el-upload>

                    </el-form-item>
                </el-col>

                <el-col :sm="12" v-if="user.user_type === 'artist'">
                    <el-form-item>
                        <span slot="label">
                            Profile background image
                                    <el-popover
                                            width="200"
                                            trigger="hover">
                                        <span>
                                            Make your profile more professional,
                                           put on background extra picture of your studio or yourself during
                                           working or even your favourite art.
                                        </span>
                                       <i slot="reference" class="el-icon-info"></i>
                                   </el-popover>
                        </span>
                        <el-upload
                                class="profile-image"
                                action="/api/user/upload-user-image"
                                :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                                :show-file-list="false"
                                accept="image/*"
                                :on-success="handleImageSuccess"
                                :before-upload="beforeImageUpload">
                            <el-button slot="trigger" icon="el-icon-picture"  class="profile-avatar-button" circle></el-button>
                            <div slot="tip" class="el-upload__tip">*Must be a .jpg file smaller than 10MB and at least 980px width.</div>

                            <img :src="'/imagecache/height-200' + user.image_url" class="image">
                        </el-upload>
                    </el-form-item>
                </el-col>

            </el-row>


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
            </el-row>


            <!-- Username selection component -->
            <el-row :gutter="20">
                <el-col v-if="user.profile_premium_add && user.user_type === 'artist'">
                    <el-form-item label="Your public username ( Personal profile url link )" prop="user_name">
                        <el-input v-model="user.user_name" style="max-width: 290px; margin-right: 20px;"></el-input>

                        <el-button type="text">
                            <a :href="userName" target="_blank">
                                {{ userName }}
                            </a>
                        </el-button>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="20">
                <el-col :sm="8">
                    <el-form-item prop="email">
                        <span slot="label">Email <change-email-form></change-email-form></span>
                        <el-input v-model="user.email" disabled
                                  style="max-width: 290px;margin-right: 20px;"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8" v-if="user.user_type === 'artist'">
                    <el-form-item label="Optional Email for client communication" prop="optional_email">
                        <el-input type="email" v-model="user.optional_email"
                                  style="max-width: 290px;margin-right: 20px;"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="20" v-if="user.user_type === 'artist'">
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

                <el-col :sm="8">
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
                <el-col :sm="8">
                    <el-form-item label="Profession" prop="profession">
                        <el-select value="" v-model="user.profession" multiple filterable allow-create
                                   default-first-option collapse-tags
                                   placeholder="What is your profession?">
                            <el-option v-for="profession in options('profession')" :key="profession.value"
                                       :label="profession.label"
                                       :value="profession.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="20">
                <el-col :sm="8">
                    <el-form-item label="Name of the last finished school " prop="education">
                        <el-input v-model="user.education"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="University educational title" prop="education_title">
                        <el-select value="" v-model="user.education_title" filterable allow-create>
                            <el-option v-for="title in options('education')" :key="title.value" :label="title.label"
                                       :value="title.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Skill origin" prop="education_born">
                        <el-switch
                                v-model="user.education_born"
                                active-text="Natural Born Artist"
                                inactive-text="Educated Artist">
                        </el-switch>
                    </el-form-item>
                </el-col>

            </el-row>

            <el-row :gutter="20" v-if="user.user_type === 'artist'">

                <el-col :sm="8">
                    <el-form-item label="Date of birth" prop="dob">
                        <el-date-picker
                                v-model="user.dob"
                                type="date"
                                value-format="yyyy-MM-dd"
                                placeholder="yyyy-mm-dd">
                        </el-date-picker>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Gender" prop="gender">
                        <el-select value="user.gender" v-model="user.gender">
                            <el-option v-for="gender in options('gender')" :key="gender.value" :label="gender.label"
                                       :value="gender.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Phone" prop="phone">
                        <vue-tel-input v-model="user.phone" @onInput="setphoneNumber"
                                       :preferredCountries="['us', 'gb', 'ua']"></vue-tel-input>
                    </el-form-item>
                </el-col>

            </el-row>

            <el-row :gutter="20">
                <el-col :sm="8">
                    <el-form-item label="City" prop="city">
                        <el-input v-model="user.city"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Region" prop="region">
                        <el-input v-model="user.region"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Postcode" prop="postcode">
                        <el-input v-model="user.postcode"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Address" prop="address">
                        <el-input placeholder="Address" v-model="user.address">
                        </el-input>
                    </el-form-item>
                </el-col>
            </el-row>


            <el-row :gutter="20">

                <el-col>

                    <el-form-item prop="inspiration">
                        <span slot="label">Inspiration</span>
                        <vue-editor id="inspiration" v-model="user.inspiration"
                                    :editorToolbar="profileEditorToolbar"></vue-editor>
                    </el-form-item>

                </el-col>

                <el-col>
                    <el-form-item label="Exhibitions" prop="exhibition">
                        <span slot="label">Exhibitions</span>
                        <vue-editor id="exhibition" v-model="user.exhibition"
                                    :editorToolbar="profileEditorToolbar"></vue-editor>
                    </el-form-item>
                </el-col>

            </el-row>

            <el-button type="primary" style="margin-top: 20px"
                       size="big"
                       @click="save()" :loading="loading">
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
        },

        data() {
            let userNameValidator = (rule, value, callback) => {
                if (!value) {
                    callback();
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
                loading: false,
                user: {},
                profileSaved: false,
                rules: {
                    first_name: [
                        {required: true, message: 'Please enter first name', trigger: 'blur'}
                    ],
                    last_name: [
                        {required: true, message: 'Please enter last name', trigger: 'blur'}
                    ],
                    optional_email: [
                        {type: 'email', message: 'Email is not valid', trigger: 'blur'}
                    ],
                    user_name: [
                        {validator: userNameValidator, trigger: 'blur'}
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
                ],
                dialogs: {
                    profileBackgroundImageAddDialog: false,
                }


            }
        },

        mounted() {
            this.csrf = window.csrf;

            if (this.user_) {
                this.user = JSON.parse(this.user_);
            }

            axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });
        },

        methods: {
            setphoneNumber({number, isValid, country}) {
                console.log(number, isValid, country);
            },

            handleAvatarSuccess(response, file) {
                console.log(response);
                this.user.avatar_url = response.data;
            },

            handleImageSuccess(response, file) {
                console.log(response);
                this.user.image_url = response.data;
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
                const isJPG = file.type === 'image/jpeg' || file.type === 'image/jpg';
                const isLt2M = file.size / 1024 / 1024 < 10;

                if (!isJPG) {
                    this.$message.error('Image picture must be JPG or JPEG format!');
                }
                if (!isLt2M) {
                    this.$message.error('Image picture size can not exceed 10MB!');
                }
                return isJPG && isLt2M;
            },

            save() {
                this.$refs['profile'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        axios.post('/api/profile/', this.user)
                            .then((response) => {
                                console.log(response.data);
                                this.$message({
                                    showClose: true,
                                    message: response.data.message,
                                    type: response.data.status
                                });
                                this.profileSaved = true;
                                this.loading = false;
                                console.log(response.data);
                            }).catch(error => {
                            console.log(error.response);
                        });
                    }
                });
            },

        },
        computed: {
            userName() {
                return window.location.origin + '/' + (this.user.user_name ? this.user.user_name : 'artist/' + this.user.id);
            },
        }
    }
</script>

<style lang="scss">

    /*.avatar-uploader .el-upload, .image-uploader .el-upload {*/
        /*border: 1px dashed #d9d9d9;*/
        /*border-radius: 6px;*/
        /*cursor: pointer;*/
        /*position: relative;*/
        /*overflow: hidden;*/

        /*&:hover {*/
            /*border-color: #409EFF;*/
        /*}*/
    /*}*/

    /*.avatar {*/
        /*width: 178px;*/
        /*height: 178px;*/
        /*display: block;*/
    /*}*/

    /*.image {*/
        /*!*width: 178px;*!*/

        /*height: 178px;*/
        /*display: block;*/
    /*}*/


</style>