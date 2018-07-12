 <template>

    <el-card v-if="user">

        <h2>Personal Information</h2>

        <el-form label-position="top" :model="user" :rules="rules" ref="profile">

            <label class="el-form-item__label">Upload Your Photo ( jpg/png files accepted )</label>
            <el-form-item>
                <el-upload
                        :action="'/api/upload/user-photo/' + user.id"
                        list-type="list"
                        :file-list="user.photo"
                        :on-preview="handlePictureCardPreview"
                        :on-remove="handleRemove"
                        :on-success="handleSuccess"
                        accept=".jpg, .jpeg, .png">
                    <el-button type="info" plain>
                        <i class="el-icon-upload"></i>
                        Upload photo
                    </el-button>
                </el-upload>

                <el-dialog :visible.sync="dialogVisible">
                    <img width="100%" :src="dialogImageUrl" alt="">
                </el-dialog>
            </el-form-item>

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

                <el-col>
                    <el-form-item label="Address 2" prop="address_2">
                        <el-input
                                ref="autocomplete"
                                type="textarea"
                                :rows="2"
                                placeholder="Address 2"
                                v-model="user.address_2">
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
                        <el-select value="" v-model="user.technique" multiple filterable allow-create default-first-option  placeholder="What do you work with?">
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

            if (this.user.photo) {
                this.user.photo = [this.user.photo];
            } else {
                this.user.photo = [];
            }

            if( !this.user_.technique) {
                this.user.technique = [];
            }

            console.log(google.maps.places);


            this.user.address_2 = new google.maps.places.Autocomplete(
                (this.$refs.autocomplete),
                {types: ['geocode']}
            );

            this.user.address_2.addListener('place_changed', () => {
                let place = this.autocomplete.getPlace();
                let ac = place.address_components;
                let lat = place.geometry.location.lat();
                let lon = place.geometry.location.lng();
                let city = ac[0]["short_name"];

                console.log(place);
                console.log(`The user picked ${city} with the coordinates ${lat}, ${lon}`);
            });
        },

        methods: {

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

            handlePictureCardPreview(file) {
                this.setDialogUrl();
                this.dialogVisible = true;
            },

            setDialogUrl() {
                this.dialogImageUrl = '/user/' + this.user.id + '/' + this.user.photo[0].name;
            },

            handleSuccess(response, file) {
                console.log('success');
                console.log(file);
                this.user.photo = [{
                    name: file.name,
                    url: file.url
                }];
            }
        }
    }
</script>