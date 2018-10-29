<template>
    <el-card  v-if="page" >
        <el-form label-position="top" :model="page" ref="page" :rules="rules">

            <el-row :gutter="20" style="margin-bottom: 20px">

                <el-col :span="12">
                    <el-form-item :label="'Page name ' + (page.id ? page.id : '')" prop="name" required>
                        <el-input v-model="page.name" placeholder="Name"></el-input>
                    </el-form-item>
                </el-col>

            </el-row>

            <el-tabs type="card">

                <template v-for="language in languages">

                    <el-tab-pane :label="language.name">

                        <quill-editor v-model="page.content[language.code]"></quill-editor>

                    </el-tab-pane>

                </template>

            </el-tabs>

            <el-button type="primary" style="margin-top: 20px"  @click="save()" :loading="loading">
                Save
            </el-button>
        </el-form>

    </el-card>

</template>

<script>

    import quillEditor from 'vue-quill-editor'

    export default {
        components: quillEditor,

        props: {
            page_: {}
        },
        data() {
            return {
                loading: false,
                page: {
                    content: {}
                },
                languages: {},
                rules: {
                    name: [{required: true, message: 'Please enter the name of page', trigger: ['blur', 'change', 'submit']},],
                },
            }
        },
        mounted() {

            axios.get('/api/languages').then(response => {
                this.languages = response.data;

                if (this.page_) {
                    this.page = JSON.parse(this.page_);
                } else {
                    for (let index in this.languages) {
                        this.$set(this.page.content, this.languages[index].code, "")
                    }
                }
            });
        },
        methods: {
            save() {
                console.log(1);
                this.$refs['page'].validate((valid) => {
                    if (valid) {
                        this.loading = true;
                        console.log(this.page);

                        if (this.page_) {
                            axios.post('/api/page/' + this.page.id, this.page)
                                .then((response) => {
                                    console.log(response.data);
                                    window.location = '/dashboard/page';
                                }).catch(error => {
                                console.log(error.response);
                            });
                        } else {
                            axios.post('/api/page/', this.page)
                                .then((response) => {
                                    console.log(response.data);
                                    window.location = '/dashboard/page';
                                }).catch(error => {
                                console.log(error.response);
                            });
                        }
                    }
                });

            }
        }
    }
</script>

<style scoped>

</style>