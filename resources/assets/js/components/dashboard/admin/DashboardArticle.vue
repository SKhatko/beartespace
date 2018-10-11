<template>
    <div class="app-dashboard-article">
        <el-card>
            <el-form>
                <el-form-item label="Title">
                    <el-input v-model="article.name"></el-input>
                </el-form-item>
                <el-form-item label="content">
                    <vue-editor v-model="article.content"></vue-editor>
                    <!--<el-input v-model="article.content"></el-input>-->
                </el-form-item>

                <el-button @click="save()">Save</el-button>
            </el-form>
        </el-card>
    </div>
</template>

<script>
    import { VueEditor } from 'vue2-editor'

    export default {

        components: {
            VueEditor
        },

        props: {
            article_: {},
        },
        data() {
            return {
                article: {},
            }
        },
        mounted() {
            if (this.article_) {
                this.article = JSON.parse(this.article_);
            }
        },
        methods: {

            save() {
                // this.$refs['article'].validate((valid) => {
                //     if (valid) {
                //         this.loading = true;
                        console.log(this.article);

                        if(this.article_) {
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

                    // }
                // });
            },
        }
    }
</script>

<style scoped>

</style>