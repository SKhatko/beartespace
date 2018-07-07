 <template>

    <el-card v-if="user">

        <h2>Personal Information</h2>

        <el-form label-position="top">

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
                    <!--<i class="el-icon-plus"></i>-->
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
                    <el-form-item label="First name">
                        <el-input v-model="user.first_name"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="Last name">
                        <el-input v-model="user.last_name"></el-input>
                    </el-form-item>
                </el-col>


                <el-col :sm="12">
                    <el-form-item label="Username ( Name that will be shown on your profile )">
                        <el-input v-model="user.user_name"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Email">
                        <el-input v-model="user.email"></el-input>
                    </el-form-item>
                </el-col>


                <el-col :sm="8">
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
                </el-col>
                <el-col :sm="8">
                    <el-form-item label="Gender">
                        <el-select value="user.gender" v-model="user.gender">
                            <el-option value="male">Male</el-option>
                            <el-option value="female">Femail</el-option>
                            <el-option value="third_gender">Third</el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :sm="8">
                    <el-form-item label="Date of birth">
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
                    <el-form-item label="Website">
                        <el-input placeholder="Website" v-model="user.website"></el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Phone">
                        <el-input v-model="user.phone"></el-input>
                    </el-form-item>
                </el-col>

                <el-col>
                    <el-form-item label="Address">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Address"
                                v-model="user.address">
                        </el-input>
                    </el-form-item>
                </el-col>

                <el-col>
                    <el-form-item label="Address 2">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Address 2"
                                v-model="user.address_2">
                        </el-input>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Education">
                        <el-input v-model="user.education"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="University educational title">
                        <el-input v-model="user.education_title"></el-input>
                    </el-form-item>
                </el-col>

                <el-col>
                    <el-form-item label="Technique">
                        <el-select value="" v-model="user.technique" multiple filterable allow-create default-first-option  placeholder="What do you work with?">
                            <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                       :value="medium.value"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>

                <el-col :sm="12">
                    <el-form-item label="Inspiration">
                        <el-input
                                type="textarea"
                                :rows="2"
                                placeholder="Things that inspire you"
                                v-model="user.inspiration">
                        </el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="Exhibitions">
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