<template>
    <el-card>

        <h2 v-if="artwork_">Edit Artwork</h2>
        <h2 v-else>Upload Artwork</h2>

        <el-form label-position="top" :model="artwork" ref="artwork" :rules="updateArtworkRules" v-if="artwork">

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
                        <el-input-number v-model="artwork.width" :min="0.1" :max="200" size="small"
                                         :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Height, cm" prop="height">
                        <el-input-number v-model="artwork.height" :min="0.1" :max="200" size="small"
                                         :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Depth,cm" prop="depth">
                        <el-input-number v-model="artwork.depth" :min="0.1" :max="200" size="small"
                                         :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Weight, g" prop="weight">
                        <el-input-number v-model="artwork.weight" :min="1" :max="10000" size="small"
                                         :precision="0"></el-input-number>
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
                        <el-input-number v-model="artwork.b_width" :min="0.1" :max="200" size="small"
                                         :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Total Height, cm" prop="b_height">
                        <el-input-number v-model="artwork.b_height" :min="0.1" :max="200" size="small"
                                         :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Total Depth,cm" prop="b_depth">
                        <el-input-number v-model="artwork.b_depth" :min="0.1" :max="200" size="small"
                                         :precision="1"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :sm="5">
                    <el-form-item label="Total Weight, g" prop="b_weight">
                        <el-input-number v-model="artwork.b_weight" :min="1" :max="10000" size="small"
                                         :precision="0"></el-input-number>
                    </el-form-item>
                </el-col>

            </el-row>


            <el-row :gutter="20">

                <el-col :sm="8">
                    <el-form-item label="How many items do you want sell?" prop="quantity">
                        <el-input-number :min="1" :precision="0" v-model="artwork.quantity" :disabled="showArtworkQuantity"></el-input-number>
                    </el-form-item>
                </el-col>

                <el-col :sm="8">
                    <el-form-item label="Is your artwork unique">
                        <el-switch
                                v-model="artwork.unique"
                                active-text="Artwork is unique"
                                inactive-text="Artwork exists in few pieces">
                        </el-switch>
                    </el-form-item>
                </el-col>


            </el-row>

            <template v-if="artwork_">

                <el-row :gutter="20">
                    <el-col :sm="8">
                        <el-form-item label="Medium">
                            <el-select value="" v-model="artwork.medium" multiple filterable allow-create collapse-tags
                                       default-first-option placeholder="Select material">
                                <el-option v-for="medium in options('medium')" :key="medium.value" :label="medium.label"
                                           :value="medium.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="8">
                        <el-form-item label="Art direction">
                            <el-select value="" v-model="artwork.direction" multiple filterable allow-create
                                       collapse-tags
                                       default-first-option placeholder="Select">
                                <el-option v-for="direction in options('direction')" :key="direction.value"
                                           :label="direction.label"
                                           :value="direction.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="8">
                        <el-form-item label="Theme">
                            <el-select value="" v-model="artwork.theme" multiple filterable allow-create collapse-tags
                                       default-first-option placeholder="Select">
                                <el-option v-for="theme in options('theme')" :key="theme.value" :label="theme.label"
                                           :value="theme.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="8">
                        <el-form-item label="Main colors">
                            <el-select value="" v-model="artwork.color" multiple filterable allow-create collapse-tags
                                       default-first-option placeholder="Select">
                                <el-option v-for="color in options('color')" :key="color.value" :label="color.label"
                                           :value="color.value">
                                    <span :style="{float: 'left', marginRight: '10px', width: '30px',height: '30px',backgroundColor: color.value}"></span>
                                    {{ color.label }}
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="8">
                        <el-form-item label="Artwork shape">
                            <el-select value="" v-model="artwork.shape" filterable allow-create collapse-tags
                                       default-first-option placeholder="Select shape">
                                <el-option v-for="shape in options('shape')" :key="shape.value" :label="shape.label"
                                           :value="shape.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>

                <!-- Description, Inspiration -->
                <el-row :gutter="20">
                    <el-col>
                        <el-form-item label="Artwork Description">
                            <vue-editor id="description" v-model="artwork.description"
                                        placeholder="Artwork description"
                                        :editorToolbar="artworkEditorToolbar"></vue-editor>
                        </el-form-item>
                    </el-col>

                    <el-col>
                        <el-form-item>
                            <span slot="label" v-if="showArtworkInspiration">
                                <el-button type="text" @click="dialogs.artworkInspirationAddDialog = true"
                                           v-if="showArtworkInspiration">
                                    Add inspiration of your artwork to attract more customers
                                </el-button>
                                <el-dialog
                                        title="Upgrade Your Artwork"
                                        :visible.sync="dialogs.artworkInspirationAddDialog"
                                        width="30%">
                                    <p>Buyers love stories, attract them to your art, show your art in the best possible way.</p>
                                    <p>Sent us keywords and we can write a short story about your work to convince others why is so
                                        unique. The description of your inspiration is best to write in English.</p>
                                    <span slot="footer" class="dialog-footer">
                                <el-button type="primary"
                                           @click="saveArtwork(false, confirmArtworkUpgrade('artwork_inspiration_add', 1))">Confirm</el-button>
                              </span>
                                </el-dialog>
                            </span>
                            <span slot="label" v-else>Inspiration</span>

                            <vue-editor id="inspiration" v-model="artwork.inspiration"
                                        placeholder="Things that inspire you"
                                        :editorToolbar="artworkEditorToolbar"></vue-editor>
                        </el-form-item>
                    </el-col>

                </el-row>


                <!--  Date of completion, price -->
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
                        <el-form-item label="Price, Eur">
                            <el-input-number value="2" v-model="artwork.price" :min="1" :max="50000"></el-input-number>

                            <span class="h4">Your profit: {{ artwork.price }} - 15% = {{ profitPrice }} Eur</span>
                            <!--<el-select value="" v-model="artwork.currency" placeholder="Select currency"-->
                                       <!--style="max-width: 200px;margin-left: 20px;">-->
                                <!--<el-option v-for="(label, value) in currencies" :key="value" :value="value"-->
                                           <!--:label="value"></el-option>-->
                            <!--</el-select>-->
                        </el-form-item>

                    </el-col>
                </el-row>

                <el-row :gutter="20" style="margin-bottom: 20px;">
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

                    <el-col :sm="8">
                        <el-form-item label="Mark artwork as sold">
                            <el-checkbox v-model="artwork.sold" @click="">Sold</el-checkbox>
                        </el-form-item>
                    </el-col>

                    <el-col :sm="8">
                        <el-switch
                                v-model="artwork.available"
                                active-text="Artwork available for sale"
                                inactive-text="Temporary unavailable">
                        </el-switch>
                    </el-col>

                </el-row>

                <el-form-item label="Upload main image of your Artwork ( jpg/jpeg files accepted)">

                    <el-upload
                            class="image-uploader"
                            :action="'/api/artwork/'  + artwork.id + '/upload-artwork-image/'"
                            :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                            :show-file-list="false"
                            accept=".jpg, .jpeg"
                            :on-success="handleImageSuccess"
                            :before-upload="beforeImageUpload">
                        <img v-if="artwork.image" :src="'/imagecache/height-200/' + artwork.image.url" class="image">
                    </el-upload>

                </el-form-item>

                <el-form-item label="Upload additional images like back side, signature, or artwork from side. Up to 3
                    Photos of Your Artwork allowed( .jpg, .jpeg files accepted)">
                    <el-upload
                            :action="'/api/artwork/'  + artwork.id + '/upload-artwork-images/'"
                            :file-list="artwork.images"
                            :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemove"
                            :on-success="handleImagesSuccess"
                            :limit="3"
                            :on-exceed="handleExceed"
                            list-type="picture-card"
                            accept=".jpg, .jpeg">
                        <i class="el-icon-plus"></i>
                    </el-upload>

                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>
                </el-form-item>


                <el-button type="primary" style="margin-top: 20px"
                           size="big"
                           @click="saveArtwork()" :loading="loading">Save
                </el-button>

                <el-button type="primary" v-if="artworkSaved" style="margin-top: 20px" size="big">
                    <a :href="'/artwork/' + artwork.id" target="_blank">Preview</a>
                </el-button>

            </template>

            <template v-else>

                <el-button type="primary" style="margin-top: 20px"
                           size="big" :loading="loading"
                           @click="saveArtwork(true)" icon="el-icon-arrow-right">Create
                </el-button>

            </template>

        </el-form>

    </el-card>

</template>

<script>

    import {VueEditor} from 'vue2-editor'

    export default {

        props: {
            artwork_: {},
            currencies_: {},
            user_: {}
        },

        data() {
            return {
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
                dialogs: {
                    artworkOptionsAddDialog: false,
                    artworkInspirationAddDialog: false,
                },
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
                    ]
                },

                artworkEditorToolbar: [
                    [{'size': ['small', false, 'large', 'huge']}],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{'align': ''}, {'align': 'center'}, {'align': 'right'}, {'align': 'justify'}],
                    ['blockquote'],
                    [{'list': 'ordered'}, {'list': 'bullet'}, {'list': 'check'}],
                    [{'indent': '-1'}, {'indent': '+1'}],
                ],

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

            console.log(this.artwork);

        },

        methods: {

            saveArtwork(redirect = false, callback = () => {}) {
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

                                        this.artworkSaved = true;
                                        this.artwork = response.data.data;
                                        this.loading = false;

                                        callback();
                                    }
                                } else {
                                    console.log(response.data);
                                }
                            });
                    }
                });

            },
            handleExceed() {
                this.$message({
                    message: 'Maximum quantity of images is 3',
                    type: 'warning'
                });
            },
            handleRemove(file, fileList) {
                axios.post('/api/artwork/' + this.artwork.id + '/remove-artwork-image/', file)
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
                    }).catch(error => {
                    console.log(error);
                });

                // this.images = fileList;
            },
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },
            handleImagesSuccess(response, file, fileList) {
                console.log(response);
                this.artwork.images = response.data;
            },

            handleImageSuccess(response, file) {
                console.log(response);
                this.artwork.image = response.data;
                this.$message({
                    showClose: true,
                    message: response.message,
                    type: response.status
                });
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

            confirmArtworkUpgrade(name, price, period = null) {
                axios.get('/api/artwork-add/' + this.artwork.id + '/' + name + '/' + price + '/' + period).then(response => {
                    this.$alert(response.data.message, '', {
                        confirmButtonText: 'OK',
                        type: 'success',
                        callback: action => {
                            this.artwork = response.data.data;
                            this.closeDialogs();
                        }
                    });
                })
            },
            closeDialogs() {
                for (let dialog in this.dialogs) {
                    this.dialogs[dialog] = false;
                }
            }

        },
        computed: {
            profitPrice() {
                return this.artwork.price - (this.artwork.price * 15 / 100);
            },
            showArtworkQuantity() {
                return this.artwork.unique;
            },
            showArtworkOptions() {
                return !this.user.profile_premium_add && !this.artwork.artwork_options_add;
            },
            showArtworkInspiration() {
                return !this.user.profile_premium_add && !this.artwork.artwork_inspiration_add;
            }
        }
    }
</script>