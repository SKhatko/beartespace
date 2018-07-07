<template>


    <el-card>


        <h2 v-if="artwork_">Edit Artwork</h2>
        <h2 v-else>Upload Artwork</h2>

        <el-form label-position="top">

            <el-form-item>

                <el-steps :active="activeStep" process-status="process" finish-status="success" align-center>
                    <el-step title="Add description" icon="el-icon-edit"></el-step>
                    <el-step title="Upload Images" icon="el-icon-picture"></el-step>
                    <el-step title="Done" icon="el-icon-star-off"></el-step>
                </el-steps>

            </el-form-item>


            <template v-if="activeStep === 0">


                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Artwork Name (Title)">
                            <el-input placeholder="Please input" v-model="artwork.title"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Select Category">
                            <el-select value="" v-model="artwork.category" placeholder="Select">
                                <el-option v-for="(label, value) in trans('category')" :key="value" :value="value"
                                           :label="label"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>


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

                <el-form-item >
                    <el-checkbox v-model="artwork.optional_size" v-if="artwork.category === 'painting'">Has frame</el-checkbox>
                    <el-checkbox v-model="artwork.optional_size" v-if="artwork.category === 'sculpture'">Has base</el-checkbox>

                </el-form-item>

                <el-form :inline="true" label-position="top" v-if="artwork.optional_size">
                    <el-form-item label="Total Width">
                        <el-input-number v-model="artwork.b_width"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Total Height">
                        <el-input-number v-model="artwork.b_height"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Total Depth">
                        <el-input-number v-model="artwork.b_depth"></el-input-number>
                    </el-form-item>

                    <el-form-item label="Total Weight">
                        <el-input-number v-model="artwork.b_weight"></el-input-number>
                    </el-form-item>
                </el-form>

                <el-row :gutter="20">
                    <el-col :sm="6">
                        <el-form-item label="Medium">
                            <el-select value="" v-model="artwork.medium" multiple filterable allow-create default-first-option  placeholder="Select material">
                                <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                           :value="medium.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Art direction">
                            <el-select value="" v-model="artwork.direction" multiple filterable allow-create default-first-option placeholder="Select" >
                                <el-option v-for="direction in options('direction')" :key="direction.value"
                                           :label="direction.label"
                                           :value="direction.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Theme">
                            <el-select value="" v-model="artwork.theme" multiple filterable allow-create default-first-option placeholder="Select">
                                <el-option v-for="theme in options('theme')" :key="theme.value" :label="theme.label"
                                           :value="theme.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Main colors">
                            <el-select value="" v-model="artwork.color" multiple filterable allow-create default-first-option placeholder="Select">
                                <el-option v-for="color in options('color')" :key="color.value" :label="color.label"
                                           :value="color.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Artwork Description">
                            <el-input
                                    type="textarea"
                                    :rows="2"
                                    placeholder="Description"
                                    v-model="artwork.description">
                            </el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Inspiration">
                            <el-input
                                    type="textarea"
                                    :rows="2"
                                    placeholder="Things that inspire you"
                                    v-model="artwork.inspiration">
                            </el-input>
                        </el-form-item>
                    </el-col>
                </el-row>


                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Date of completion Artwork">
                            <el-date-picker
                                    v-model="artwork.date_of_completion"
                                    type="year"
                                    value-format="yyyy-MM-dd"
                                    placeholder="Pick a year">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Price ( EUR )">
                            <el-input-number value="2" v-model="artwork.price" :min="1" :max="50000"></el-input-number>
                        </el-form-item>
                    </el-col>
                </el-row>


                <el-button type="primary" style="margin-top: 20px"
                           size="big"
                           @click="saveArtwork()" icon="el-icon-arrow-right">
                    Next
                </el-button>

            </template>


            <template v-if="activeStep === 1">

                {{ images }}

                <label class="el-form-item__label">Upload up to 3 Photos of Your Artwork ( jpg/png files accepted
                    )</label>
                <el-form-item>
                    <el-upload
                            :action="'/api/upload/artwork-image/' + artwork.id"
                            :file-list="images"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            :on-success="handleSuccess"
                            :limit="3"
                            :on-exceed="handleExceed"
                            accept=".jpg, .jpeg, .png">
                        <el-button type="info" plain>
                            <i class="el-icon-upload"></i>
                            Upload images
                        </el-button>
                    </el-upload>

                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>
                </el-form-item>


                <el-form-item>
                    <el-button type="primary"
                               size="big"
                               @click="saveArtwork(true)"
                               icon="el-icon-arrow-right">
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
                        <a href="/dashboard" target="_blank">
                            Preview
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
            user_: {},
            images_: {},
        },

        data() {
            return {
                artwork: {
                    id: 0,
                    user_id: '',
                    title: '',
                    description: '',
                    height: '',
                    width: '',
                    depth: '',
                    weight: '',
                    inspiration: '',
                    date_of_completion: '',
                    price: '',

                    category: '',

                    medium: [],
                    direction: [],
                    theme: [],
                    color: [],
                },

                images: [],

                activeStep: 0,

                dialogImageUrl: '',
                dialogVisible: false

            }
        },


        mounted() {
            console.log(this.artwork_);
            console.log(this.user_);
            console.log(this.images_);

            if (this.artwork_) {
                this.artwork = this.artwork_;
            }

            if(!this.artwork.user_id) {
                this.artwork.user_id = this.user_.id
            }

            if(this.images_) {
                this.images = this.images_;
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

                            if (response.data.status = 'success') this.activeStep++;
                            // window.location.reload();
                        } else {
                            console.log(response.data);
                        }
                    });
            },
            handleExceed(a, b, c) {
                console.log(a, b, c);
            },
            handleRemove(file, fileList) {
                axios.post('/api/remove/artwork-image/' + this.artwork.id, file)
                    .then((response) => {
                        if (response.data) {
                            console.log(response.data);
                            this.$message({
                                showClose: true,
                                message: response.data.message,
                                type: response.data.status
                            });

                            this.images = response.data.data;
                        } else {
                            console.log(response.data);
                        }
                    });

                // this.images = fileList;
            },
            handlePictureCardPreview(file) {
                this.setDialogUrl(file.name);
                this.dialogVisible = true;
            },
            setDialogUrl(name) {
                this.dialogImageUrl = '/artwork/' + this.artwork.id + '/' + name;
            },
            handleSuccess(response, file, fileList) {
                this.images.push({
                    name: file.name,
                    url: file.url
                });
            }
        }
    }
</script>