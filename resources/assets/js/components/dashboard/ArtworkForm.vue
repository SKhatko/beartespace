<template>
    <el-card>

        <h2 v-if="artwork_">Edit Artwork</h2>
        <h2 v-else>Upload Artwork</h2>

        <el-form label-position="top" :model="artwork" ref="artwork" :rules="updateArtworkRules">

            <el-row :gutter="20">
                <el-col :sm="12">
                    <el-form-item label="Artwork Name (Title)" prop="title">
                        <el-input placeholder="Please input" v-model="artwork.title"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :sm="12">
                    <el-form-item label="Select Category" prop="category">
                        <el-select value="" v-model="artwork.category" placeholder="Select">
                            <el-option v-for="(label, value) in trans('category')" :key="value" :value="value"
                                       :label="label"></el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row>
                <el-col :sm="5">
                    <el-form-item label="Width, cm" prop="width">
                        <el-input-number v-model="artwork.width" :min="0.1" :max="200" size="small" :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Height, cm" prop="height">
                        <el-input-number v-model="artwork.height" :min="0.1" :max="200" size="small" :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Depth,cm" prop="depth">
                        <el-input-number v-model="artwork.depth" :min="0.1" :max="200" size="small" :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Weight, g" prop="weight">
                        <el-input-number v-model="artwork.weight" :min="1" :max="10000" size="small" :precision="0"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="4" style="margin-top: 50px;">
                    <el-form-item>
                        <el-checkbox v-model="artwork.optional_size" v-if="artwork.category === 'painting'">Has frame
                        </el-checkbox>
                        <el-checkbox v-model="artwork.optional_size" v-if="artwork.category === 'sculpture'">Has base
                        </el-checkbox>
                    </el-form-item>
                </el-col>
            </el-row>

            <el-row v-if="artwork.optional_size">
                <el-col :sm="5">
                    <el-form-item label="Total Width, cm" prop="b_width">
                        <el-input-number v-model="artwork.b_width" :min="0.1" :max="200" size="small" :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Total Height, cm" prop="b_height">
                        <el-input-number v-model="artwork.b_height" :min="0.1" :max="200" size="small" :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Total Depth,cm" prop="b_depth">
                        <el-input-number v-model="artwork.b_depth" :min="0.1" :max="200" size="small" :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Total Weight, g" prop="b_weight">
                        <el-input-number v-model="artwork.b_weight" :min="1" :max="10000" size="small" :precision="0"></el-input-number>
                    </el-form-item>
                </el-col>

            </el-row>

            <template v-if="artwork_">

                <!--    Medium, color, theme, art direction -->
                <el-dialog
                        title="Upgrade Your Artwork"
                        :visible.sync="artworkOptionsAddDialog"
                        width="30%">
                    <p>We offer you to give more descriptions for your artwork, so customers can find your artwork by medium (material), orientation, art direction or even basic colors.</p>
                    <p>Add more search options for 1 EUR</p>
                    <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="confirmArtworkUpgrade('artwork_options_add', 1)">Confirm</el-button>
              </span>
                </el-dialog>

                <el-button type="text" @click="artworkOptionsAddDialog = true" v-if="!!user.profile_website || !artwork.artwork_options_add">
                    Add medium, orientation, art direction to attract more customers
                </el-button>

                <el-row :gutter="20" v-if="user.profile_website || artwork.artwork_options_add">
                    <el-col :sm="6">
                        <el-form-item label="Medium">
                            <el-select value="" v-model="artwork.medium" multiple filterable allow-create
                                       default-first-option placeholder="Select material">
                                <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                           :value="medium.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Art direction">
                            <el-select value="" v-model="artwork.direction" multiple filterable allow-create
                                       default-first-option placeholder="Select">
                                <el-option v-for="direction in options('direction')" :key="direction.value"
                                           :label="direction.label"
                                           :value="direction.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Theme">
                            <el-select value="" v-model="artwork.theme" multiple filterable allow-create
                                       default-first-option placeholder="Select">
                                <el-option v-for="theme in options('theme')" :key="theme.value" :label="theme.label"
                                           :value="theme.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Main colors">
                            <el-select value="" v-model="artwork.color" multiple filterable allow-create
                                       default-first-option placeholder="Select">
                                <el-option v-for="color in options('color')" :key="color.value" :label="color.label"
                                           :value="color.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="6">
                        <el-form-item label="Artwork shape">
                            <el-select value="" v-model="artwork.shape" filterable allow-create
                                       default-first-option placeholder="Select shape">
                                <el-option v-for="shape in options('shape')" :key="shape.value" :label="shape.label"
                                           :value="shape.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <!-- Description, Inspiration -->
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

                    <el-col :sm="12" v-if="user.profile_website || artwork.artwork_inspiration_add">
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


                <el-dialog
                        title="Upgrade Your Artwork"
                        :visible.sync="artworkInspirationAddDialog"
                        width="30%">
                    <p>Buyers love stories, attract them to your art, show your art in the best possible way.</p>
                    <p>Sent us keywords and we can write a short story about your work to convince others why is so unique. The description of your inspiration is best to write in English.</p>
                    <p>Make your artwork more attractive for  1 EUR</p>
                    <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="confirmArtworkUpgrade('artwork_inspiration_add', 1)">Confirm</el-button>
              </span>
                </el-dialog>

                <el-button type="text" @click="artworkInspirationAddDialog = true" v-if="!!user.profile_website || !artwork.artwork_inspiration_add">
                    Add inspiration of your artwork to attract more customers
                </el-button>


                <!--  Date of compleation, price -->
                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Date of completion Artwork">

                            <el-date-picker
                                    v-model="artwork.date_of_completion"
                                    type="year"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    placeholder="Pick a year">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Price">
                            <el-input-number value="2" v-model="artwork.price" :min="1" :max="50000"></el-input-number>

                            <el-select value="" v-model="artwork.currency" placeholder="Select currency"
                                       style="max-width: 200px;margin-left: 20px;">
                                <el-option v-for="(label, value) in currencies" :key="value" :value="value"
                                           :label="value"></el-option>
                            </el-select>
                        </el-form-item>

                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="8">
                        <el-form-item label="Your artworks can be sold on auction">
                            <el-checkbox v-model="artwork.auction_status" border>Place for auction</el-checkbox>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="8">
                        <el-form-item label="Auction end date">
                            <el-date-picker
                                    v-model="artwork.auction_end"
                                    type="datetime"
                                    value-format="yyyy-MM-dd HH:mm:ss"
                                    placeholder="Select date and time">
                            </el-date-picker>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="8" v-if="artwork.auction_status">
                        <el-form-item label="Starting price on auction ( EUR )">
                            <el-input-number value="2" v-model="artwork.auction_price" :min="1"
                                             :max="50000"></el-input-number>
                        </el-form-item>
                    </el-col>

                </el-row>

                <label class="el-form-item__label">Upload images of back side, signature, or artwork from side. Up to 3
                    Photos of Your Artwork allowed( jpg/png files accepted)</label>
                <el-form-item>
                    <el-upload
                            :action="'/api/upload/artwork-image/' + artwork.id"
                            :file-list="artwork.images"
                            :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
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
                        <img width="100%" :src="'/' + dialogImageUrl" alt="">
                    </el-dialog>
                </el-form-item>


                <el-button type="primary" style="margin-top: 20px"
                           size="big"
                           @click="saveArtwork()" :loading="loading" icon="el-icon-arrow-right">
                    Save
                </el-button>

                <el-button type="primary" v-if="artworkSaved" style="margin-top: 20px"
                           size="big">
                    <a :href="'/artworks/' + artwork.id" target="_blank">
                        Preview
                    </a>
                </el-button>

            </template>

            <template v-else>

                <el-button type="primary" style="margin-top: 20px"
                           size="big" :loading="loading"
                           @click="saveArtwork(true)" icon="el-icon-arrow-right">
                    Create
                </el-button>

            </template>

        </el-form>

    </el-card>

</template>

<script>

    export default {

        props: {
            artwork_: {},
            currencies_: {},
            user_: {}
        },

        data() {
            return{
                user: {},
                csrf: window.csrf,
                currencies: [],
                artwork: {
                    medium: [],
                    direction: [],
                    theme: [],
                    color: [],
                    images: [],
                },
                artworkOptionsAddDialog: false,
                artworkInspirationAddDialog: false,
                updateArtworkRules: {
                    title: [
                        {required: true, message: 'Please input title of artwork', trigger: ['blur', 'change']},
                    ],
                    category: [
                        {required: true, message: 'Please select category', trigger: ['blur', 'change']}
                    ],
                    width: [
                        {required: true, message: 'Please select width', trigger: ['blur', 'change']}
                    ],
                    b_width: [
                        {required: true, message: 'Please select width', trigger: ['blur', 'change']}
                    ],
                    height: [
                        {required: true, message: 'Please select height', trigger: ['blur', 'change']}
                    ],
                    b_height: [
                        {required: true, message: 'Please select height', trigger: ['blur', 'change']}
                    ],
                    depth: [
                        {required: true, message: 'Please select depth', trigger: ['blur', 'change']}
                    ],
                    b_depth: [
                        {required: true, message: 'Please select depth', trigger: ['blur', 'change']}
                    ],
                    weight: [
                        {required: true, message: 'Please select weight', trigger: ['blur', 'change']}
                    ],
                    b_weight: [
                        {required: true, message: 'Please select weight', trigger: ['blur', 'change']}
                    ],
                },

                artworkSaved: false,
                loading: false,

                dialogImageUrl: '',
                dialogVisible: false
            }
        },


        mounted() {

            if (this.artwork_) {
                this.artwork = JSON.parse(this.artwork_);
            }

            if (this.currencies_) {
                this.currencies = JSON.parse(this.currencies_);
            }

            if (this.user_) {
                this.user = JSON.parse(this.user_);
            }

            console.log(this.$refs['artwork']);

        },

        methods: {

            saveArtwork(redirect = false) {
                this.$refs['artwork'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        axios.post('/api/artwork/', this.artwork)
                            .then((response) => {
                                if (response.data.data) {
                                    console.log(response.data);

                                    if (redirect) {
                                        window.location.pathname = '/dashboard/artwork/' + response.data.data.id + '/edit';
                                    } else {
                                        this.$message({
                                            showClose: true,
                                            message: response.data.message,
                                            type: response.data.status
                                        });

                                        this.artwork = response.data.data;
                                        this.loading = false;
                                    }
                                } else {
                                    console.log(response.data);
                                }
                            });
                    }
                });

            },
            mainPhotoExceed() {
                this.$message({
                    message: 'Maximum quantity of images is 1',
                    type: 'warning'
                });
            },
            handleExceed() {
                this.$message({
                    message: 'Maximum quantity of images is 3',
                    type: 'warning'
                });
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

                            this.artwork.images = response.data.data;
                        } else {
                            console.log(response.data);
                        }
                    });

                // this.images = fileList;
            },
            handlePictureCardPreview(file) {
                console.log(file);
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },

            handleSuccess(response, file, fileList) {
                this.artwork.images.push({
                    name: file.name,
                    url: file.url
                });
            },

            confirmArtworkUpgrade(name, price, period = null) {
                axios.get('/api/artwork-add/' + this.artwork.id + '/' + name + '/' + price + '/' + period).then(response => {
                    console.log(response.data);
                    // this.user = response.data.data;

                    this.$alert(null, response.data.message, {
                        confirmButtonText: 'OK',
                        callback: action => {
                            // window.location.reload();
                        }
                    });
                    // this.$message({
                    //     showClose: true,
                    //     message: response.data.message,
                    //     type: response.data.status
                    // });
                })
            },

        }
    }
</script>