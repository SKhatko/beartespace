<template>

    <el-card v-if="user">

        <div v-if="user.user_type === 'user'">User</div>
        <div v-if="user.user_type === 'artist'">Artist</div>
        <div v-if="user.user_type === 'gallery'">Gallery</div>
        <div v-if="user.user_type === 'admin'">Admin</div>

        <h2>Profile information</h2>

        <el-form label-position="top">

            <el-row :gutter="20">

                <el-col :sm="12">
                    <el-form-item
                            :label="'Click on image to upload ' + (user.user_type === 'gallery' ? 'logo' : 'avatar')">

                        <el-upload
                                class="avatar-uploader"
                                action="/api/upload/user-avatar"
                                :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                                :show-file-list="false"
                                accept="image/*"
                                :on-success="handleAvatarSuccess"
                                :before-upload="beforeAvatarUpload">
                            <img v-if="user.avatar_url" :src="'/imagecache/avatar/' + user.avatar_url" class="avatar">
                        </el-upload>

                        <el-button type="text" @click="profileWebsiteDialog = true"
                                   v-if="!user.profile_website && user.user_type === 'artist'">
                            Make your personal website
                        </el-button>

                        <el-dialog
                                title="Your own Web Site "
                                :visible.sync="profileWebsiteDialog"
                                width="30%">
                            <p>Have you thought about having your own website? You did not know how to deal with it?</p>
                            <p>it seemed to be too difficult? With BeArte Space, it takes you just a few moments and you
                                can start
                                selling from your own site.</p>
                            <p>You can personalize your web site and adjust to your desire. Choosing your
                                own web site, you don’t have to pay for adds, they are already included to your account.
                                See example
                                <a href="/" target="_blank">here</a></p>
                            <p>Save 1 month by selecting annually plan</p>

                            <span slot="footer" class="dialog-footer">
                                <el-button type="success"
                                           @click="confirmProfileUpgrade('profile_website', 30, 'month')">Confirm Monthly</el-button>
                                <el-button type="primary"
                                           @click="confirmProfileUpgrade('profile_website', 279, 'year')">Confirm Annually</el-button>
                              </span>
                        </el-dialog>

                        <el-button type="text" @click="profileEducationDialog = true"
                                   v-if="!user.profile_website && !user.profile_education && user.user_type === 'artist'">
                            Add your education to attract more customers
                        </el-button>

                        <el-dialog
                                title="Upgrade Your profile"
                                :visible.sync="profileEducationDialog"
                                width="30%">
                            <p>You can add title, and art school you finished to your personal profile for 1 EUR</p>
                            <span slot="footer" class="dialog-footer">
                <el-button type="primary"
                           @click="confirmProfileUpgrade('profile_education', 1)">Confirm</el-button>
              </span>
                        </el-dialog>

                        <el-button type="text" @click="profileInspirationDialog = true"
                                   v-if="!user.profile_website && !user.profile_inspiration && user.user_type === 'artist'">
                            Add your inspiration to attract more customers
                        </el-button>

                        <el-dialog
                                title="Upgrade Your profile"
                                :visible.sync="profileInspirationDialog"
                                width="30%">
                            <p>What is inspiring you, why you are the Artist? It is very important to attract
                                customers.</p>
                            <p>Sent us key-word and we will write a short story about what inspires you, why you create
                                the art, why you are the unique artist. The best is write your inspiration in
                                English.</p>
                            <p>You can add this feature to your personal profile for 2 EUR</p>
                            <span slot="footer" class="dialog-footer">
                <el-button type="primary"
                           @click="confirmProfileUpgrade('profile_inspiration', 2)">Confirm</el-button>
              </span>
                        </el-dialog>

                    </el-form-item>
                </el-col>

                <el-col :sm="12" v-if="user.profile_website && user.user_type === 'artist'">
                    <el-form-item label="Click on image to upload profile background image">
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
                <el-col v-if="user.profile_website && user.user_type === 'artist'">
                    <el-form-item label="Your public username ( Personal website url )" prop="user_name">
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
                        <el-input v-model="user.email" disabled style="max-width: 290px;margin-right: 20px;"></el-input>
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
                        <el-select value="" v-model="user.profession" multiple filterable allow-create default-first-option
                                   placeholder="What is your profession?">
                            <el-option v-for="profession in options('profession')" :key="profession.value"
                                       :label="profession.label"
                                       :value="profession.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row :gutter="20" v-if="user.profile_website || user.profile_education && user.user_type === 'artist' ">
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

            <el-row :gutter="20" v-if="user.user_type === 'artist' ">

                <el-col :sm="12">
                    <el-form-item label="Technique" prop="technique">
                        <el-select value="" v-model="user.medium" multiple filterable allow-create
                                   default-first-option placeholder="What do you work with?">
                            <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                       :value="medium.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Art Direction" prop="direction">
                        <el-select value="" v-model="user.direction" multiple filterable allow-create
                                   default-first-option placeholder="What is your Art direction?">
                            <el-option v-for="direction in options('direction')" :key="direction.value"
                                       :label="direction.label"
                                       :value="direction.value"></el-option>
                        </el-select>
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
                        <el-input v-model="user.phone"></el-input>
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

                <el-col :sm="12" v-if="user.profile_website || user.profile_inspiration && user.user_type === 'artist'">
                    <el-form-item label="Inspiration" prop="inspiration">
                        <vue-editor id="inspiration" v-model="user.inspiration"
                                    :editorToolbar="profileEditorToolbar"></vue-editor>
                    </el-form-item>
                </el-col>

                <el-col :sm="12" v-if="user.profile_website || user.profile_exhibitions && user.user_type === 'artist'">
                    <el-form-item label="Exhibitions" prop="exhibition">
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
                profileWebsiteDialog: false,
                profileEducationDialog: false,
                profileInspirationDialog: false,

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

            confirmProfileUpgrade(name, price, period = null) {
                axios.get('/api/user-add/' + name + '/' + price + '/' + period).then(response => {
                    console.log(response.data);
                    this.user = response.data.data;

                    this.$alert(null, response.data.message, {
                        confirmButtonText: 'OK',
                        callback: action => {
                            window.location.reload();
                        }
                    });
                    // this.$message({
                    //     showClose: true,
                    //     message: response.data.message,
                    //     type: response.data.status
                    // });
                })
            },

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
                        this.loading = true;
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
                                    this.loading = false;
                                } else {
                                    console.log(response.data);
                                }
                            });
                    }
                });
            }
        },
        computed: {
            userName() {
                return window.location.origin + '/' + (this.user.user_name ? this.user.user_name : 'artist/' + this.user.id);
            }
        }
    }
</script>

<style lang="scss">

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