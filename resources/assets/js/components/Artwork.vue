<template>


    <el-card>

        <h2>Upload Artwork</h2>

        <el-form label-position="top">


            <el-form-item label="Artwork Name (Title)">
                <el-input></el-input>
            </el-form-item>


            <el-form-item label="Select Category">
                <el-select value="" placeholder="Select">
                    <el-option
                            value="Painting">
                    </el-option>
                    <el-option
                            value="Sculpture">
                    </el-option>
                </el-select>
            </el-form-item>

            Size inputs

            <el-form-item label="Medium">
                <el-select value="" placeholder="Select">
                    <el-option
                            value="Acrylic">
                    </el-option>
                    <el-option
                            value="Oil">
                    </el-option>
                </el-select>
            </el-form-item>


            <el-form-item label="Art direction">
                <el-select value="" placeholder="Select">
                    <el-option
                            value="Colorism">
                    </el-option>
                    <el-option
                            value="Realism">
                    </el-option>
                </el-select>
            </el-form-item>

            <el-form-item label="Theme">
                <el-select value="" placeholder="Select">
                    <el-option
                            value="Portrait">
                    </el-option>
                    <el-option
                            value="Maritime">
                    </el-option>
                </el-select>
            </el-form-item>


            <el-form-item label="Main colors">
                <el-select value="" placeholder="Select">
                    <el-option
                            value="Yellow">
                    </el-option>
                    <el-option
                            value="Blue">
                    </el-option>
                </el-select>
            </el-form-item>


            <el-form-item label="Artwork Description">
                <el-input
                        type="textarea"
                        :rows="2"
                        placeholder="Description"
                        v-model="artwork.description">
                </el-input>
            </el-form-item>

            <el-form-item label="Date of completion Artwork">
                <el-date-picker
                        type="date"
                        value-format="yyyy-MM-dd"
                        placeholder="Date">
                </el-date-picker>
            </el-form-item>

            <el-form-item label="Price">
                <el-input-number value="2" controls-position="right" :min="1" :max="50000"></el-input-number>
            </el-form-item>

            <el-form-item label="Inspiration">
                <el-input
                        type="textarea"
                        :rows="2"
                        placeholder="Things that inspire you"
                        v-model="artwork.inspiration">
                </el-input>
            </el-form-item>


            <label class="el-form-item__label">Upload up to 3 Photos of Your Artwork ( jpg/png files accepted )</label>
            <el-form-item>
                <el-upload
                        :action="'/api/upload/artwork-photo/' + artwork.id"
                        list-type="picture-card"
                        :file-list="artworkPhoto"
                        :on-preview="handlePictureCardPreview"
                        :on-remove="handleRemove"
                        :on-success="handleSuccess"
                        accept=".jpg, .jpeg, .png">
                    <!--<i class="el-icon-plus"></i>-->
                    Upload Photo
                </el-upload>

                <el-dialog :visible.sync="dialogVisible">
                    <img width="100%" :src="dialogImageUrl" alt="">
                </el-dialog>
            </el-form-item>


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
            artwork_: {},
        },

        data() {
            return {
                artwork: {
                    id: 0,
                    title: '',
                    description: '',
                    height: '',
                    width: '',
                    depth: '',
                    weight: '',
                    inspiration: '',
                    date_of_completion: '',
                    price: '',

                    category_id: '',

                    medium: '',
                    direction: '',
                    theme: '',
                    color: '',
                },
                countries: [],

                artworkPhoto: [],
                dialogImageUrl: '',
                dialogVisible: false
            }
        },


        mounted() {
            if (this.artwork_) {
                this.artwork = this.artwork_;
            }

            if (this.artwork.photo) {
                this.artworkPhoto = [{
                    name: this.artwork.photo,
                    url: '/avatars/' + this.artwork.id + '/' + this.artwork.photo
                }];
            }
        },

        methods: {

            save() {

                this.artwork.photo = this.artworkPhoto.length ? this.artworkPhoto[0].name : '';

                axios.post('/api/artwork/', this.artwork)
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
                this.artworkPhoto = [];
            },
            handlePictureCardPreview(file) {
                this.setDialogUrl();
                this.dialogVisible = true;
            },
            setDialogUrl() {
                this.dialogImageUrl = '/avatars/' + this.artwork.id + '/' + this.artworkPhoto[0].name;
            },
            handleSuccess(response, file) {
                console.log('success');
                this.artworkPhoto = [{
                    name: file.name,
                    url: file.url
                }];
            }
        }
    }
</script>