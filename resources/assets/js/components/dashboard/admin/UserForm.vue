<template>

    <div class="app-dashboard-user-form">

        <errors></errors>

        <!-- Seller -->
        <template v-if="user.seller_type === 'artist' || user.seller_type === 'gallery'">

            <el-form label-position="top" :model="user" ref="profile">

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Seller status">
                            <el-select value="" v-model="user.seller_status"
                                       placeholder="Seller status">
                                <el-option v-for="status in options('seller-status')" :key="status.value"
                                           :label="status.label"
                                           :value="status.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item>

                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row :gutter="20" v-if="!request_seller_type_">
                    <el-col :sm="12">
                        <el-form-item prop="image">
                            <img v-if="user.avatar_url" :src="'/imagecache/fit-75' + user.avatar_url"
                                 class="avatar">
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12" style="display: none;">
                        <el-form-item>
                            <img :src="'/imagecache/height-200' + user.image_url" class="image">
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="12" v-if="user.seller_type === 'gallery' || request_seller_type_ === 'gallery'">
                        <el-form-item label="Business name / Gallery name" prop="company_name">
                            <el-input v-model="user.company_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="First name" prop="first_name" required>
                            <el-input v-model="user.first_name"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Last name" prop="last_name" required>
                            <el-input v-model="user.last_name"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Website / Portfolio" prop="website">
                            <el-input v-model="user.website"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row v-if="request_seller_type_ === 'artist' || user.seller_type === 'artist'">
                    <el-form-item label="Gender" prop="gender">
                        <el-radio-group v-model="user.gender">
                            <el-radio v-for="gender in options('gender')" :key="gender.value" :label="gender.value">{{
                                gender.label }}
                            </el-radio>
                        </el-radio-group>
                    </el-form-item>
                </el-row>

                <el-row :gutter="20" v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col :sm="12">
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
                    <el-col :sm="12">
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
                            <el-input v-model="user.city" placeholder="City"></el-input>
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row :gutter="20">

                    <el-col :sm="12">
                        <el-form-item label="Region" prop="region">
                            <el-input v-model="user.region"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="Postcode" prop="postcode">
                            <el-input v-model="user.postcode"></el-input>
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row :gutter="20">

                    <el-col :sm="12">
                        <el-form-item label="Address" prop="address">
                            <el-input placeholder="Address" v-model="user.address">
                            </el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="Phone" prop="phone">
                            <el-input v-model="user.phone" style="display:none"></el-input>
                            <vue-tel-input v-model="user.phone" @onInput="setPhoneNumber"
                                           :preferredCountries="['dk', 'gb', 'ua']"></vue-tel-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col :sm="12">
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

                <el-row :gutter="20" v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col :sm="12">
                        <el-form-item label="Skill origin" prop="education_born">
                            <el-switch
                                    v-model="user.education_born"
                                    active-text="Natural Born Artist"
                                    inactive-text="Educated Artist">
                            </el-switch>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="Website / Portfolio" prop="website">
                            <el-input v-model="user.website"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col :sm="12">
                        <el-form-item label="Name of the last finished school" prop="education">
                            <el-input v-model="user.education"></el-input>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="12">
                        <el-form-item label="University educational title" prop="education_title">
                            <el-select value="" v-model="user.education_title" filterable allow-create>
                                <el-option v-for="title in options('education')" :key="title.value"
                                           :label="title.label"
                                           :value="title.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col>
                        <el-form-item>
                            <span slot="label">About</span>
                            <el-input type="textarea" v-model="user.about"
                                      placeholder="Let people know something about you"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20" v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col>
                        <el-form-item prop="inspiration">
                            <span slot="label">Inspiration</span>
                            <el-input type="textarea" v-model="user.inspiration"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row v-if="user.seller_type === 'artist' || request_seller_type_ === 'artist'">
                    <el-col>
                        <el-form-item label="Exhibitions" prop="exhibition">
                            <span slot="label">Exhibitions</span>
                            <el-input type="textarea" v-model="user.exhibition"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>


                <div style="margin-top: 20px;text-align: right;">
                    <el-button v-if="user.seller_status === 'active'">
                        <a :href="'/' + user.profile_name" target="_blank">Preview</a>
                    </el-button>

                    <el-button type="danger" @click="deleteUser">Delete User</el-button>

                    <el-button type="primary" @click="save()" :loading="loading">
                        Save
                    </el-button>
                </div>

            </el-form>

        </template>

        <!-- User -->
        <template v-else>

            <el-form label-position="top" :model="user" status-icon :rules="userRules" ref="profile">

                <el-col :sm="12">
                    <el-form-item label="User status">
                        <el-select value="" v-model="user.seller_status"
                                   placeholder="Seller status">
                            <el-option v-for="status in options('seller-status')" :key="status.value"
                                       :label="status.label"
                                       :value="status.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Profile picture">
                            <img v-if="user.avatar_url" :src="'/imagecache/fit-75' + user.avatar_url">
                        </el-form-item>
                    </el-col>
                </el-row>

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
                    <el-col :sm="12">
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
                            <el-input v-model="user.city" placeholder="City"></el-input>
                        </el-form-item>
                    </el-col>

                </el-row>

                <el-row>
                    <el-col :sm="12">
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
                    <el-col>
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

    </div>

</template>

<script>

    export default {

        props: {
            user_: {},
            request_seller_type_: null,
        },

        data() {

            return {
                loading: false,
                user: {},
                sellerRules: {
                    // first_name: [
                    //     {required: true, message: 'Please enter first name', trigger: 'blur'}
                    // ],
                    // last_name: [
                    //     {required: true, message: 'Please enter last name', trigger: 'blur'}
                    // ],
                    // company_name: [
                    //     {required: true, message: 'Please enter the name of your business', trigger: 'blur'}
                    // ],
                    // gender: [
                    //     {required: true, message: 'Please specify your sex', trigger: 'blur'}
                    // ],
                    // nationality_id: [
                    //     {required: true, message: 'Please enter your nationality', trigger: 'blur'}
                    // ],
                    // profession: [
                    //     {required: true, message: 'Please select your profession', trigger: 'blur'}
                    // ],
                    // country_id: [
                    //     {required: true, message: 'Please specify your country', trigger: 'blur'}
                    // ],
                    // city: [
                    //     {required: true, message: 'Please specify your city', trigger: 'blur'}
                    // ],
                    // region: [
                    //     {required: true, message: 'Please specify your region', trigger: 'blur'}
                    // ],
                    // postcode: [
                    //     {required: true, message: 'Please specify your postcode', trigger: 'blur'}
                    // ],
                    // address: [
                    //     {required: true, message: 'Please enter your address', trigger: 'blur'}
                    // ],
                    // dob: [
                    //     {required: true, message: 'Please specify your date of birth', trigger: 'blur'}
                    // ],
                    // phone: [
                    //     {required: true, message: 'Please enter valid phone number', trigger: 'blur'}
                    // ]
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

            deleteUser() {
                this.$confirm('This will permanently delete' + this.user.name + '. Continue?', 'Danger', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {

                    axios.post('/api/users/' + this.user.id, this.user).then(response => {
                        // this.$message({
                        //     type: response.data.type,
                        //     message: response.data.message
                        // });
                        window.location = '/dashboard/users';
                        console.log(response.data);
                    });
                });
            },

            setPhoneNumber({number, isValid, country}) {
                console.log(number, isValid, country);
            },

            save() {
                this.$refs['profile'].validate((valid) => {
                    if (valid) {
                        this.loading = true;

                        axios.put('/api/users/' + this.user.id, this.user)
                            .then((response) => {
                                console.log(response.data);
                                window.location = '/dashboard/users';
                            }).catch(error => {
                            this.loading = false;
                            console.log(error.response);
                            this.$store.commit('setErrors', error.response.data.errors);

                        });

                    }
                });
            },
        },
    }
</script>

<style lang="scss">

</style>