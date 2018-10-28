<template>
    <div class="app-dashboard-article">
        <el-card>
            <el-form label-position="top" :model="article" ref="article" :rules="rules" v-if="article" class="article">

                <el-form-item label="Title" prop="name" required>
                    <el-input v-model="article.name"></el-input>
                </el-form-item>

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Source">
                            <el-input v-model="article.source"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Source url">
                            <el-input v-model="article.source_url"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>

                <el-row :gutter="20">
                    <el-col :sm="12">
                        <el-form-item label="Tags">
                            <el-select value="" v-model="article.tags" multiple filterable allow-create collapse-tags
                                       default-first-option placeholder="Select tags">
                                <el-option v-for="tag in article.tags" :key="tag" :label="tag"
                                           :value="tag"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                    <el-col :sm="12">
                        <el-form-item label="Category" prop="category">
                            <el-select value="" v-model="article.category" placeholder="Select Category">
                                <el-option v-for="(label, value) in trans('article-category')" :key="value" :value="value"
                                           :label="label"></el-option>
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-row>


                <el-form-item>

                    <el-upload
                            class="article-image"
                            list-type="picture-card"
                            :file-list="article.image"
                            action="/api/article/upload-article-image"
                            :headers="{'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN' : csrf}"
                            accept=".jpg, .jpeg"
                            :on-preview="handlePictureCardPreview"
                            :on-remove="handleRemoveImage"
                            :on-success="handleImageSuccess"
                            :before-upload="beforeImageUpload">
                        <div class="article-image-label">
                            <i class="el-icon-picture"></i>
                            <div>Primary image</div>
                        </div>
                    </el-upload>

                    <el-dialog :visible.sync="dialogVisible">
                        <img width="100%" :src="dialogImageUrl" alt="">
                    </el-dialog>

                </el-form-item>

                <el-form-item label="Content" required prop="content">

                    <quill-editor v-model="article.content"
                                  ref="myQuillEditor"
                                  :options="editorOption"></quill-editor>

                </el-form-item>

                <el-button @click="save()">Save</el-button>
            </el-form>
        </el-card>
    </div>
</template>

<script>

    import {quillEditor, Quill} from 'vue-quill-editor'
    import {container, ImageExtend, QuillWatch} from 'quill-image-extend-module'
    import ImageResize from 'quill-image-resize-module'

    Quill.register('modules/ImageExtend', ImageExtend);
    Quill.register('modules/ImageResize', ImageResize);

    export default {
        components: {quillEditor},

        props: {
            article_: {},
        },
        data() {
            return {
                csrf: '',
                article: {
                    image: [],
                    tags: [],
                },
                dialogImageUrl: '',
                dialogVisible: false,
                loading: false,
                rules: {
                    name: [
                        {required: true, message: 'Please enter the name of article', trigger: ['blur', 'change']},
                    ],
                    content: [
                        {required: true, message: 'Content is required', trigger: ['blur', 'change']},
                    ],
                },
                editorOption: {
                    modules: {
                        ImageResize: {},
                        ImageExtend: {
                            name: 'file',
                            size: 10,  // 2m, 1M = 1024KB
                            action: '/api/article/upload-article-images',
                            headers: (xhr) => {
                                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                                xhr.setRequestHeader('X-CSRF-TOKEN' , this.csrf);
                            },
                            sizeError: () => {
                                alert('Max image size is 10Mb')
                            },
                            response: (res) => {
                                return res.data.url
                            }
                        },
                        toolbar: {
                            container: container,
                            handlers: {
                                'image': function () {
                                    QuillWatch.emit(this.quill.id)
                                }
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.csrf = window.csrf;

            if (this.article_) {
                this.article = JSON.parse(this.article_);
                this.article.image = [this.article.image];
            }

            console.log(this.article);

        },
        methods: {
            handlePictureCardPreview(file) {
                this.dialogImageUrl = file.url;
                this.dialogVisible = true;
            },

            handleRemoveImage(file, fileList) {
                this.article.image = [];
                this.article.image_id = null;
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

            handleImageSuccess(response, file) {
                console.log(response.data);
                this.article.image = [response.data];
                this.article.image_id = response.data.id;
            },

            save() {
                this.$refs['article'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        console.log(this.article);

                        if (this.article_) {
                            axios.post('/api/article/' + this.article.id, this.article)
                                .then((response) => {
                                    console.log(response.data);
                                    window.location = '/dashboard/article';
                                }).catch(error => {
                                console.log(error.response);
                            });
                        } else {
                            axios.post('/api/article/', this.article)
                                .then((response) => {
                                    console.log(response.data);
                                    window.location = '/dashboard/article';
                                }).catch(error => {
                                console.log(error.response);
                            });
                        }
                    }
                });
            },
        }
    }
</script>

<style scoped>

</style>