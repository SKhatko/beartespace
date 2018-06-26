<template>


    <el-card>


        <h2 v-if="artwork_">Edit Artwork</h2>
        <h2 v-else>Upload Artwork</h2>

        {{ artwork_ }}

        <el-form label-position="top">

            <el-form-item>

                <el-steps :active="activeStep" process-status="process" finish-status="success" align-center>
                    <el-step title="Add description" icon="el-icon-edit"></el-step>
                    <el-step title="Upload Images" icon="el-icon-picture"></el-step>
                    <el-step title="Done" icon="el-icon-picture"></el-step>
                </el-steps>

            </el-form-item>


            <template v-if="activeStep === 0">



                <el-form-item label="Artwork Name (Title)">
                    <el-input placeholder="Please input" v-model="artwork.title"></el-input>
                </el-form-item>


                <el-form-item label="Select Category">
                    <el-select value="" v-model="artwork.category" placeholder="Select">
                        <el-option label="Painting"
                                   value="painting">
                        </el-option>
                        <el-option label="Sculpture"
                                   value="sculpture">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form :inline="true" label-position="top">
                    <el-form-item label="Width">
                        <el-input-number v-model="artwork.width"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Height">
                        <el-input-number v-model="artwork.height"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Depth">
                        <el-input-number v-model="artwork.depth"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Weight">
                        <el-input-number v-model="artwork.weight"></el-input-number>
                    </el-form-item>
                </el-form>


                <el-form-item label="Medium">
                    <el-select value="" v-model="artwork.medium" placeholder="Select">
                        <el-option
                                label="Acrylic"
                                value="1">
                        </el-option>
                        <el-option
                                label="Oil"
                                value="2">
                        </el-option>
                    </el-select>
                </el-form-item>


                <el-form-item label="Art direction">
                    <el-select value="" v-model="artwork.direction" placeholder="Select">
                        <el-option
                                label="Colorism"
                                value="1">
                        </el-option>
                        <el-option
                                label="Realism"
                                value="2">
                        </el-option>
                    </el-select>
                </el-form-item>

                <el-form-item label="Theme">
                    <el-select value="" v-model="artwork.theme" placeholder="Select">
                        <el-option
                                label="Portrait"
                                value="1">
                        </el-option>
                        <el-option
                                label="Maritime"
                                value="2">
                        </el-option>
                    </el-select>
                </el-form-item>


                <el-form-item label="Main colors">
                    <el-select value="" v-model="artwork.color" placeholder="Select">
                        <el-option
                                label="Yellow"
                                value="1">
                        </el-option>
                        <el-option
                                label="Blue"
                                value="2">
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

                <el-form-item label="Inspiration">
                    <el-input
                            type="textarea"
                            :rows="2"
                            placeholder="Things that inspire you"
                            v-model="artwork.inspiration">
                    </el-input>
                </el-form-item>

                <el-form-item label="Date of completion Artwork">
                    <el-date-picker
                            v-model="artwork.year_of_completion"
                            type="year"
                            value-format="yyyy"
                            placeholder="Pick a year">
                    </el-date-picker>
                </el-form-item>

                <el-form-item label="Price ( EUR )">
                    <el-input-number value="2" v-model="artwork.price" :min="1" :max="50000"></el-input-number>
                </el-form-item>

                <el-button type="primary" style="margin-top: 20px"
                           size="big"
                           @click="saveArtwork()">
                    Next
                </el-button>

            </template>


            <template v-if="activeStep === 1">

                <label class="el-form-item__label">Upload up to 3 Photos of Your Artwork ( jpg/png files accepted )</label>
                <el-form-item>
                    <el-upload
                            :action="'/api/upload/artwork-image/' + artwork.id"
                            list-type="picture-card"
                            :file-list="artworkPhoto"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            :on-success="handleSuccess"
                            accept=".jpg, .jpeg, .png">
                        <!--<i class="el-icon-plus"></i>-->
                        Upload Images
                    </el-upload>

                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>
                </el-form-item>


                <el-form-item>
                    <el-button type="primary"
                               size="big"
                               @click="saveImages">
                        Next
                    </el-button>

                    <el-button type="text" @click="activeStep--">Back to edit artwork</el-button>

                </el-form-item>

            </template>


            <template v-if="activeStep === 2">

                <div class="text-center">
                    Your work being approved. You'll get email once it's published.
                </div>

                <el-form-item>
                    <el-button type="primary" style="margin-top: 20px"
                               size="big"
                               @click="activeStep++">
                        <a href="/dashboard">
                            Go to panel
                        </a>
                    </el-button>

                    <el-button type="text" @click="activeStep--">Back to edit artwork</el-button>

                </el-form-item>

            </template>



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
                    year_of_completion: '',
                    price: '',

                    category: '',

                    medium: '',
                    direction: '',
                    theme: '',
                    color: '',
                },

                activeStep: 0,

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
                    url: '/artworks/' + this.artwork.id + '/' + this.artwork.photo
                }];
            }
        },

        methods: {

            saveArtwork() {
                axios.post('/api/artwork/', this.artwork)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: response.data.status
                            });

                            this.artwork = response.data.data;

                            if(response.data.status = 'success') this.activeStep++;
                            // window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            },
            saveImages() {
                // this.artwork.photo = this.artworkPhoto.length ? this.artworkPhoto[0].name : '';

            },
            handleRemove(file, fileList) {
                this.artworkPhoto = [];
            },
            handlePictureCardPreview(file) {
                this.setDialogUrl(file.name);
                this.dialogVisible = true;
            },
            setDialogUrl(name) {
                this.dialogImageUrl = '/artworks/' + this.artwork.id + '/' + name;
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