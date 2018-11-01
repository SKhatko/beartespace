<template>

    <el-card class="app-profile-form">

        <!-- Seller -->
        <template v-if="user.user_type === 'artist' || user.user_type === 'gallery'">
            <div slot="header">
                <div class="app-profile-form-header">
                    <span v-if="sellRequest_">Please fill in Profile information</span>
                    <span v-else>Your Profile</span>
                    <a v-if="!sellRequest_" :href="'/' + user.user_name" target="_blank"
                       class="el-button el-button--default el-button--mini">View profile</a>
                </div>
            </div>

            <el-form label-position="top" :model="user" status-icon :rules="sellerRules" ref="profile">

                <el-row :gutter="20">

                    <el-col :sm="12">
                        <el-form-item prop="image" required>
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
                                    class="app-profile-form-avatar"
                                    action="/api/user/upload-user-avatar"
                                    :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                                    :show-file-list="false"
                                    accept="image/*"
                                    :on-success="handleAvatarSuccess"
                                    :before-upload="beforeAvatarUpload">
                                <el-button slot="trigger" icon="el-icon-picture" class="app-profile-form-avatar-button"
                                           circle></el-button>
                                <div slot="tip" class="el-upload__tip">*Must be a .jpg, .gif or .png file smaller than
                                    10MB
                                    and at least 400px by 400px.
                                </div>

                                <img v-if="user.avatar_url" :src="'/imagecache/fit-290' + user.avatar_url"
                                     class="avatar">
                            </el-upload>

                        </el-form-item>
                    </el-col>

                    <el-col :sm="12" style="display: none;">
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
                                    class="app-profile-form-image"
                                    action="/api/user/upload-user-image"
                                    :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                                    :show-file-list="false"
                                    accept="image/*"
                                    :on-success="handleImageSuccess"
                                    :before-upload="beforeImageUpload">
                                <el-button slot="trigger" icon="el-icon-picture" class="app-profile-form-avatar-button"
                                           circle></el-button>
                                <div slot="tip" class="el-upload__tip">*Must be a .jpg file smaller than 10MB and at
                                    least
                                    980px width.
                                </div>

                                <img :src="'/imagecache/height-200' + user.image_url" class="image">
                            </el-upload>
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row :gutter="20" v-if="user.user_type === 'gallery'">
                    <el-col :sm="8">
                        <el-form-item label="Business name / Gallery name">
                            <el-input v-model="user.company_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="8">
                        <el-form-item label="First name" prop="first_name" required>
                            <el-input v-model="user.first_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="8">
                        <el-form-item label="Last name" prop="last_name" required>
                            <el-input v-model="user.last_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>


                <el-row v-if="user.user_type === 'artist'">
                    <el-form-item label="Gender" prop="gender">
                        <el-radio-group v-model="user.gender">
                            <el-radio v-for="gender in options('gender')" :key="gender.value" :label="gender.value">{{
                                gender.label }}
                            </el-radio>
                        </el-radio-group>
                    </el-form-item>
                </el-row>

                <el-row :gutter="20" v-if="user.user_type === 'artist'">
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
                        <el-form-item label="Country" prop="country_id" required>
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
                        <el-form-item label="City" prop="city">
                            <el-input v-model="user.city" placeholder="City"></el-input>
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row :gutter="20">

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

                </el-row>

                <el-row :gutter="20">

                    <el-col :sm="8">
                        <el-form-item label="Address" prop="address">
                            <el-input placeholder="Address" v-model="user.address">
                            </el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="8">
                        <el-form-item label="Phone" prop="phone">
                            <vue-tel-input v-model="user.phone" @onInput="setPhoneNumber"
                                           :preferredCountries="['us', 'gb', 'ua']"></vue-tel-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.user_type === 'artist'">
                    <el-col :sm="8">
                        <el-form-item label="Birthday" prop="dob">
                            <el-date-picker
                                    v-model="user.dob"
                                    type="date"
                                    value-format="yyyy-MM-dd"
                                    placeholder="yyyy-mm-dd">
                            </el-date-picker>
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
                        <el-form-item label="Name of the last finished school" prop="education">
                            <el-input v-model="user.education"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="8">
                        <el-form-item label="University educational title" prop="education_title">
                            <el-select value="" v-model="user.education_title" filterable allow-create>
                                <el-option v-for="title in options('education')" :key="title.value"
                                           :label="title.label"
                                           :value="title.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.user_type === 'artist'">
                    <el-col :sm="16">
                        <el-form-item>
                            <span slot="label">About</span>
                            <el-input type="textarea" v-model="user.about"
                                      placeholder="Let people know something about you"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.user_type === 'artist'">
                    <el-col :sm="16">
                        <el-form-item prop="inspiration">
                            <span slot="label">Inspiration</span>
                            <el-input type="textarea" v-model="user.inspiration"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row v-if="user.user_type === 'artist'">
                    <el-col :sm="16">
                        <el-form-item label="Exhibitions" prop="exhibition">
                            <span slot="label">Exhibitions</span>
                            <el-input type="textarea" v-model="user.exhibition"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>


                <div style="margin-top: 20px;text-align: right;">
                    <el-button v-if="!sellRequest_">
                        <a :href="'/' + user.user_name" target="_blank">Preview</a>
                    </el-button>

                    <a v-if="sellRequest_" href="/sell/profile-name" class="el-button el-button--default">Edit name</a>

                    <el-button type="primary" @click="save()" :loading="loading">
                        Save and Continue
                    </el-button>
                </div>

            </el-form>

        </template>

        <!-- User -->
        <template v-else>

            <div slot="header">
                <div class="app-profile-form-header">
                    <span>Your Public Profile</span>
                </div>
            </div>

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
                                    class="app-profile-form-avatar"
                                    action="/api/user/upload-user-avatar"
                                    :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                                    :show-file-list="false"
                                    accept="image/*"
                                    :on-success="handleAvatarSuccess"
                                    :before-upload="beforeAvatarUpload">
                                <el-button slot="trigger" icon="el-icon-picture" class="app-profile-form-avatar-button"
                                           circle></el-button>
                                <div slot="tip" class="el-upload__tip">*Must be a .jpg, .gif or .png file smaller than
                                    10MB
                                    and at least 400px by 400px.
                                </div>

                                <img v-if="user.avatar_url" :src="'/imagecache/fit-290' + user.avatar_url"
                                     class="avatar">
                            </el-upload>

                        </el-form-item>
                    </el-col>
                </el-row>
            </el-form>

            <el-form label-position="top" :model="user" status-icon :rules="userRules" ref="profile">

                <el-row :gutter="20">
                    <el-col :sm="8">
                        <el-form-item label="First name" prop="first_name">
                            <el-input v-model="user.first_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="8">
                        <el-form-item label="Last name" prop="last_name">
                            <el-input v-model="user.last_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-form-item label="Gender" prop="gender">
                        <el-radio-group v-model="user.gender">
                            <el-radio v-for="gender in options('gender')" :key="gender.value" :label="gender.value">{{
                                gender.label }}
                            </el-radio>
                        </el-radio-group>
                    </el-form-item>
                </el-row>

                <el-row :gutter="20">
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
                        <el-form-item label="City" prop="city">
                            <el-input v-model="user.city" placeholder="City"></el-input>
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row>
                    <el-col :sm="8">
                        <el-form-item label="Birthday" prop="dob">
                            <el-date-picker
                                    v-model="user.dob"
                                    type="date"
                                    value-format="yyyy-MM-dd"
                                    placeholder="yyyy-mm-dd">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row>
                    <el-col :sm="18">
                        <el-form-item>
                            <span slot="label">About</span>
                            <el-input type="textarea" v-model="user.about"
                                      placeholder="Let people know something about you"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>


                <div style="text-align: right;margin-top: 20px;">
                    <el-button type="primary" @click="save()" :loading="loading">Save</el-button>
                </div>

            </el-form>

        </template>
    </el-card>

</template>

<script>

    export default {

        props: {
            user_: {},
            sellRequest_: null,
        },

        data() {

            return {
                loading: false,
                user: {},
                sellerRules: {
                    first_name: [
                        {required: true, message: 'Please enter first name', trigger: 'blur'}
                    ],
                    last_name: [
                        {required: true, message: 'Please enter last name', trigger: 'blur'}
                    ],
                    company_name: [
                        {required: true, message: 'Please enter the name of your business', trigger: 'blur'}
                    ],
                    gender: [
                        {required: true, message: 'Please specify your sex', trigger: 'blur'}
                    ],
                    nationality_id: [
                        {required: true, message: 'Please enter your nationality', trigger: 'blur'}
                    ],
                    profession: [
                        {required: true, message: 'Please select your profession', trigger: 'blur'}
                    ],
                    country_id: [
                        {required: true, message: 'Please specify your country', trigger: 'blur'}
                    ],
                    city: [
                        {required: true, message: 'Please specify your city', trigger: 'blur'}
                    ],
                    region: [
                        {required: true, message: 'Please specify your region', trigger: 'blur'}
                    ],
                    postcode: [
                        {required: true, message: 'Please specify your postcode', trigger: 'blur'}
                    ],
                    address: [
                        {required: true, message: 'Please enter your address', trigger: 'blur'}
                    ],
                    dob: [
                        {required: true, message: 'Please specify your date of birth', trigger: 'blur'}
                    ]
                },
                userRules: {
                    first_name: [
                        {required: true, message: 'Please enter first name', trigger: 'blur'}
                    ],
                    last_name: [
                        {required: true, message: 'Please enter last name', trigger: 'blur'}
                    ]
                },
                csrf: '',
                countries: [],
            }
        },

        mounted() {
            this.csrf = window.csrf;

            if (this.user_) {
                this.user = JSON.parse(this.user_);
            }

            console.log(this.user);

            axios.get('/api/countries').then(response => {
                this.countries = response.data;
            });
        },

        methods: {

            setPhoneNumber({number, isValid, country}) {
                console.log(number, isValid, country);
            },

            handleAvatarSuccess(response, file) {
                console.log(response);
                this.user.avatar_url = response.data.url;
                this.user.avatar_id = response.data.id;
            },

            handleImageSuccess(response, file) {
                console.log(response);
                this.user.image_url = response.data.url;
                this.user.image_id = response.data.id;
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
                        console.log(this.user);
                        axios.post('/api/profile/', this.user)
                            .then((response) => {
                                console.log(response.data);

                                if (this.sellRequest_) {
                                    window.location = '/sell/artwork';
                                } else {
                                    window.location = '/dashboard';
                                }
                            }).catch(error => {
                            this.loading = false;
                            console.log(error.response);
                        });
                    }
                });
            },
        },
    }
</script>

<style lang="scss">

</style>