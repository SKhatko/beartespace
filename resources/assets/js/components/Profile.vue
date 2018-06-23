<template>

    <div v-if="user">

        <h2>Profile</h2>
        <!--
                "id": 1,
                "name": "Stanislav Khatko",
                "first_name": null,
                "last_name": null,
                "user_name": null,
                "email": "s.a.hatko@gmail.com",
                "email_token": null,
                "country_id": 228,
                "mobile": "+380994707479",
                "gender": "male",
                "address": "Schvedska Mogyla 25",
                "website": "funsite.club",
                "phone": "994707479",
                "photo": "15295139454znzq-img-4994-copy.jpg",
                "photo_storage": "public",
                "user_type": "admin",
                "active_status": "1",
                "email_verified": null,
                "activation_code": null,
                "is_online": null,
                "last_login": null,
                "created_at": "2018-01-06 12:36:58",
                "updated_at": "2018-06-20 16:59:05"-->

        1.Name
        2.Data of Birth
        3.Place of residence
        4.Education
        5.Title from the university
        5.Exhibitions
        6.Inspiration
        7.Techniques

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

        <el-form>
            <el-form-item label="Date of birth">
                <el-date-picker
                        v-model="user.dob"
                        type="date"
                        placeholder="Date of birth">
                </el-date-picker>
            </el-form-item>
        </el-form>

        <el-form :inline="true">
            <el-form-item label="Email">
                <el-input v-model="user.email"></el-input>
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

        <el-form>
            <el-form-item label="Country">
                <el-select value="user.country_id" v-model="user.country_id" placeholder="Select country">
                    <el-option
                            v-for="country in countries"
                            :key="country.id"
                            :label="country.country_name"
                            :value="country.id">
                    </el-option>
                </el-select>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="Gender">
                <el-select value="user.gender" v-model="user.gender">
                    <el-option value="male">Male</el-option>
                    <el-option value="female">Femail</el-option>
                    <el-option value="third_gender">Third</el-option>
                </el-select>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="Website">
                <el-input placeholder="Website" v-model="user.website">
                    <template slot="prepend">Http://</template>
                </el-input>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="Address">
                <el-input
                        type="textarea"
                        :rows="2"
                        placeholder="Address"
                        v-model="user.address">
                </el-input>
            </el-form-item>
        </el-form>


        <!-- TODO -->

        <el-form>
            <el-form-item label="Education">
                <el-input v-model="user.education"></el-input>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="University educational title">
                <el-input v-model="user.education_title"></el-input>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="Exhibitions">
                <el-input v-model="user.exhibition"></el-input>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="Inspiration">
                <el-input
                        type="textarea"
                        :rows="2"
                        placeholder="Inspiration"
                        v-model="user.inspiration">
                </el-input>
            </el-form-item>
        </el-form>

        <el-form>
            <el-form-item label="Exhibitions">
                <el-input v-model="user.technique"></el-input>
            </el-form-item>
        </el-form>


        <el-form>
            <el-upload
                    action="https://jsonplaceholder.typicode.com/posts/"
                    list-type="picture-card"
                    :on-preview="handlePictureCardPreview"
                    :on-remove="handleRemove">
                <i class="el-icon-plus"></i>
            </el-upload>
            <el-dialog :visible.sync="dialogVisible">
                <img width="100%" :src="dialogImageUrl" alt="">
            </el-dialog>
        </el-form>


        <el-button type="primary" style="margin-top: 20px"
                   size="big"
                   @click="save()">
            Save
        </el-button>


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

            console.log(this.user_);
            console.log(this.trans_);
            console.log(this.countries_);
        },

        methods: {

            save() {

                axios.post('/api/profile/', this.user)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            // window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            },
            handleRemove(file, fileList) {
                console.log(file, fileList);
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            }
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
        width: 178px;
        height: 178px;
        display: block;
    }
</style>